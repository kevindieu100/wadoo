<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gerfaut\Yelp\Client;
use App\Experience;
use App\Itinerary;
use Auth;

class ItineraryController extends Controller
{
  //saves itinerary to database
  public function saveItinerary(Request $request)
  {
    $user_id = Auth::id();
    $itinerary = new Itinerary();
    $itineraryJSON = json_decode($request->input('itinerary'));

    //CREATES THE ITINERARY MODEL AND SAVES TO DATABASE
    $itinerary->budgetPreference = $itineraryJSON->budgetPreference;
    $itinerary->durationPreference = $itineraryJSON->durationPreference;
    $experienceSize = sizeof($itineraryJSON->experiences);
    $itinerary->numExperiences = $experienceSize;
    $itinerary->title = $itineraryJSON->title;
    $itinerary->totalBudget = $itineraryJSON->totalBudget;
    $itinerary->totalDuration = $itineraryJSON->totalDuration;
    $itinerary->user_id = $user_id;
    $itinerary->displayBudgetPreference = $itineraryJSON->displayBudgetPreference;
    $itinerary->displayDurationPreference = $itineraryJSON->displayDurationPreference;
    $itinerary->displayBudget = $itineraryJSON->displayBudget;
    $itinerary->displayDuration = $itineraryJSON->displayDuration;
    $itinerary->save();
    $itinerary_id = $itinerary->id;

    //LOOPS THROUGH EXPERIENCES AND CREATES 1 FOR EVERY SINGLE ONE
    $experiences = $itineraryJSON->experiences;
    $counter = 0;
    foreach($experiences as $e){
      //CREATES THE EXPERIENE MODEL AND SAVES TO DATABASE
      $experience = new Experience();
      $experience->address = $e->address;
      $experience->business_name = $e->business_name;
      $experience->displayDistanceFromPrevious = $e->displayDistanceFromPrevious;
      $experience->displayDistanceToStart = $e->displayDistanceToStart;
      $experience->displayDurationFromPrevious = $e->displayDurationFromPrevious;
      $experience->displayDurationToStart = $e->displayDurationToStart;
      $experience->duration = $e->duration;
      $experience->durationFromPrevious = $e->durationFromPrevious;
      $experience->durationToStart = $e->durationToStart;
      $experience->fromPrevTravelMode = $e->fromPrevTravelMode;
      $experience->image_url = $e->image_url;
      $experience->phone = $e->phone;
      $experience->prevAddress = $e->prevAddress;
      $experience->price_estimate = $e->price_estimate;
      $experience->rating = $e->rating;
      $experience->review_count = $e->review_count;
      $experience->startAddress = $e->startAddress;
      $experience->toStartTravelMode = $e->toStartTravelMode;
      $experience->yelp_id = $e->yelp_id;
      $experience->yelp_url = $e->yelp_url;
      $experience->user_id = $user_id;
      $experience->itinerary_id = $itinerary_id;
      $experience->order = $counter;
      $experience->num_experiences = $experienceSize;
      $experience->save();
      $counter++;
    }
    return response()->json(array(
      "success" => "Saved itinerary!"
    ));
  }//saves the itinerary to the database

  //gets a preview of the itinerary
  public function getItinerary($id)
  {
    $itinerary = Itinerary::find($id);
    $experiences = $itinerary->experiences;
    $preview = TRUE;
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
      return response()->json(array(
        "experiences"=>json_encode($experiences),
        "html" => $itineraryHTML,
        "itinerary" => json_encode($itinerary)
      ));
    }
  }//end of getItienrary

  public function updateItinerary($id)
  {
    $itinerary = Itinerary::find($id)->update([
      'title' => request('newTitle')
    ]);

    return redirect()->back()
      ->with('updateSuccess','Successfully updated itinerary!');
  }//end of updateItinerary

  public function deleteItinerary($id)
  {
    $itinerary = Itinerary::find($id)->delete();

    return redirect()->back()
      ->with('updateSuccess','Successfully deleted itinerary!');
  }//end of deleteItinerary
}
