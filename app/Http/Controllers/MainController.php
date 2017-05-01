<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gerfaut\Yelp\Client;
use App\Classes\Experience;
use App\Classes\Itinerary;
use App\Models\User;
use Auth;

/*
  YELP'S BUDGET BREAKDOWN:
  $ = under $10,
  $$ = $11 - $30,
  $$$ = $31 - $60
  $$$$ = above $61
*/

class MainController extends Controller
{
    public function getMainPage()
    {
      $array = array();
      $itineraries = User::find(Auth::id())->itineraries;
      return view('main', [
        "user" => Auth::user(),
        "itineraries" => $itineraries
      ]);
    }
    //calculates the duration of the trip in seconds
    private function calculateDuration($startLocation, $endLocation){
      $response = \GoogleMaps::load('directions')
    		->setParam ([
          "origin" => $startLocation,
          "destination" => $endLocation
                    ])
                    ->get();
      return $response;
    }//end of calculateDuration

    //calls the google maps waypoint api to optimize a route between destinations
    private function callMaps($wayPoints, $originDestination){
      $response = \GoogleMaps::load('directions')
        ->setParam ([
          "origin" => $originDestination,
          "destination" => $originDestination,
          "waypoints" => $wayPoints
                    ])
                    ->get();
      return $response;
    }//end of callMaps

    //SORT HELPER, to sort by prices
    private function priceCompare($a, $b)
    {
      return $a->getPriceEstimate() < $b->getPriceEstimate();
    }//end of priceCompare

    //SORT HELPER, to sort by rating
    private function ratingCompare($a, $b)
    {
      return $a->getRating() < $b->getRating();
    }

    //SORT HELPER, to sort by review count
    private function reviewCompare($a, $b)
    {
      return $a->getReviewCount() < $b->getReviewCount();
    }

    //called and preprocesses the business and sorts by price and duration
    private function preprocessData($yelp_results, $startLocation){
      $experiences = array();
      for($i = 0; $i < 25; $i++){
        $business = $yelp_results->getBusiness($i);
        $address = "";
        $address_array = $business->getLocation()->getDisplayAddress();
        foreach($address_array as $value){
          $address .= $value;
          $address .= " ";
        }
        $experience = new Experience($business->getId(), $address, $business->getName());
        // $directionResponse = json_decode($this->calculateDuration($startLocation, $experience->getAddress()));
        $experience->setDisplayPrice($business->getPrice());
        $experience->setYelpUrl($business->getUrl());
        $experience->setRating($business->getRating());
        $experience->setImageUrl($business->getImageUrl());
        $experience->setReviewCount($business->getReviewCount());
        $experience->setPhone($business->getDisplayPhone());
        array_push($experiences, $experience);
      }
      usort($experiences, array($this, "priceCompare"));
      usort($experiences, array($this, "ratingCompare"));
      usort($experiences, array($this, "reviewCompare"));
      // usort($experiences, array($this, "durationCompare"));
      return $experiences;
    }//end of preprocessData

    //function that returns formatted waypoint data for google api
    private function formatWayPoints($addresses){
      $waypoint = "optimize:true";
      foreach($addresses as $address){
        $waypoint .= "|";
        $waypoint .= $address;
      }
      return $waypoint;
    }//end of calculation

    //function that will try and find experiences that fit budget and duration
    private function fitBudgetDuration($experiences, &$totalBudget, &$totalDuration, $startLocation, &$addresses){
      $idealExperiences = array();
      $currentBudget = $totalBudget;
      $currentDuration = $totalDuration;
      $breakOut = FALSE;
      array_push($addresses, $startLocation); //puts in as starting address
      foreach($experiences as $experience){
        if( ( ($currentBudget >= 0)&&($currentBudget <= 3) ) || ( ($currentDuration >= 0)&&($currentDuration <= 120)) ){
          $totalBudget -= $currentBudget; //so that to total duration and total budget is set
          $totalDuration -= $currentDuration;
          $breakOut = TRUE;
          break;
        }
        if( (($currentBudget - $experience->getPriceEstimate()) >= 0 )&& !($experience->getPriceEstimate() > $totalBudget) ){
          try{
            $directionFromPrevious = json_decode($this->calculateDuration($addresses[sizeof($addresses)-1], $experience->getAddress()));
            //dd($directionFromPrevious);
            $directionBackToStart = json_decode($this->calculateDuration($addresses[0], $experience->getAddress()));
            $experience->setDurations($directionFromPrevious->routes[0]->legs[0]->duration->value, $directionBackToStart->routes[0]->legs[0]->duration->value);
            $experience->setDisplayDurations($directionFromPrevious->routes[0]->legs[0]->duration->text, $directionBackToStart->routes[0]->legs[0]->duration->text);
            $experience->setDistances($directionFromPrevious->routes[0]->legs[0]->distance->value, $directionBackToStart->routes[0]->legs[0]->distance->value);
            $experience->setDisplayDistances($directionFromPrevious->routes[0]->legs[0]->distance->text, $directionBackToStart->routes[0]->legs[0]->distance->text);
            $experience->setTransportationModes($directionFromPrevious->routes[0]->legs[0]->steps[0]->travel_mode, $directionBackToStart->routes[0]->legs[0]->steps[0]->travel_mode);
            $experience->startAddress = $startLocation;
            $experience->prevAddress = $addresses[sizeof($addresses)-1];
          }catch(Exception $e){
            dd($directionResponse);
          }
          if( (($currentDuration - $experience->getTotalDuration()) >= 0) && !($experience->getPriceEstimate() > $totalBudget) ){
            array_push($idealExperiences, $experience);
            array_push($addresses, $experience->getAddress());
            $currentBudget -= $experience->getPriceEstimate();
            $currentDuration -= $experience->getTotalDuration();
          }
        }
      }//end of for loop
      if(!$breakOut){
        $totalBudget -= $currentBudget; //so that to total duration and total budget is set
        $totalDuration -= $currentDuration;
      }
      return $idealExperiences;
    }//end of fitBudgetDuration

    //starting function to generate an itinerary
    public function createItinerary(Request $request){
      //generates a yelp client
      $yelp_client = new Client(array(
          'consumerKey' => 'aauOt5-dggUlgyZIPO2Ldw',
          'consumerSecret' => 'vfvv6uDWPOWBNWpNBpq7qsBXA1JCvAL5KUKCeCIau1SqUOqNScApbMlMIvj85998',
          'apiHost' => 'api.yelp.com' // Optional, default 'api.yelp.com'
      ));
      $offset = random_int(0, 500);
      try{
        //retrieves results
        $yelp_results = $yelp_client->search(array(
          'location' => $request->input('location'),
          'price' => "1,2,3",
          'limit' => 25,
          'offset' => $offset
        ));
      } catch (Exception $e){
        return response()->json(array(
          "error" => $e->getMessage()
        ));
      }

      $startingAddress = $request->input('location');
      $businesses = $yelp_results->getBusinesses(); //array of Yelp Businesses
      $totalBudget = (int)$request->input('budget');
      $budgetPreference = $totalBudget;
      $totalDuration = (int)$request->input('seconds');
      $durationPreference = $totalDuration;
      $addresses = array();
      $experiencesJson = array();
      $processedData = $this->preprocessData($yelp_results, $startingAddress);
      $experiences = $this->fitBudgetDuration($processedData, $totalBudget, $totalDuration, $startingAddress, $addresses);
      $preview = FALSE;
      //creates the itinerary object
      $itinerary = new Itinerary($experiences, $budgetPreference, $durationPreference, $totalBudget, $totalDuration);
      $itineraryHTML = view('itinerary', [
        'preview' => $preview,
        'experiences' => $experiences,
        'itinerary' => $itinerary
      ] )->render();

      //if couldn't find any experiences, throws an error
      if(sizeof($experiences) == 0){
        return response()->json(array(
          "error" => " Failed to generate an itinerary that fits your preferences"
        ));
      }
      else{
        return json_encode(array(
          "experiences"=>json_encode($experiencesJson),
          "html" => $itineraryHTML,
          "itinerary" => json_encode($itinerary)
        ));
      }
    }//end of generateItinerary

}
