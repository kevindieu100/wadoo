<?php

namespace App\Classes;

// base class with member properties and methods
class Experience {
  /*
   * Member variables
   */
   public $yelp_id;
   public $address;
   public $business_name;
   public $yelp_url;

   public $display_price;
   public $price_estimate;

   public $rating;
   public $latitudes;
   public $longitudes;
   public $image_url;
   public $review_count;
   public $phone;

   //duration spent at place
   public $duration;
   public $displayDuration;

   public $prevAddress;
   public $durationFromPrevious=100000;
   public $displayDurationFromPrevious;
   public $distanceFromPrevious;
   public $displayDistanceFromPrevious;
   public $fromPrevTravelMode;

   //duration from the start
   public $startAddress;
   public $durationToStart = 100000;
   public $displayDurationToStart;
   public $distanceToStart;
   public $displayDistanceToStart;
   public $toStartTravelMode;

   public function __construct($id, $address, $business_name)
   {
       $this->yelp_id = $id;
       $this->address = $address;
       $this->business_name = $business_name;
       $this->duration = random_int(600, 3600);

   }//end of constructor

   public function setTransportationModes($fromPrev, $toStart)
   {
     if(strpos($fromPrev, 'ft')) {
       $this->fromPrevTravelMode = 'WALKING';
     }else{
       $this->fromPrevTravelMode = $fromPrev;
     }

     if(strpos($toStart, 'ft')) {
       $this->toStartTravelMode = 'WALKING';
     }else{
       $this->toStartTravelMode = $toStart;
     }
   }//end of setTransportationModes

   public function setDisplayDistances($fromPrevious, $toStart)
   {
     $this->displayDistanceFromPrevious = $fromPrevious;
     $this->displayDistanceToStart = $toStart;
   }

   public function setDistances($fromPrevious, $toStart)
   {
     $this->distanceFromPrevious = $fromPrevious;
     $this->distanceToStart = $toStart;
   }

   public function setDisplayDurations($fromPrevious, $toStart)
   {
     $this->displayDurationFromPrevious = $fromPrevious;
     $this->displayDurationToStart = $toStart;
   }

   public function setDurations($fromPrevious, $toStart)
   {
     $this->durationFromPrevious = $fromPrevious;
     $this->durationToStart = $toStart;
   }

   public function setDistanceFromPrevious($d)
   {
     $this->distanceFromPrevious = $d;
   }

   public function getDistanceFromPrevious()
   {
     return $this->distanceFromPrevious;
   }

   public function setDurationFromPrevious($duration)
   {
     $this->durationFromPrevious = $duration;
   }

   public function getDurationFromPrevious()
   {
     return $this->durationFromPrevious;
   }

   public function getTotalDuration()
   {
     return $this->duration + $this->durationFromPrevious + $this->durationToStart;
   }

   public function getDistanceToStart()
   {
     return $this->distanceToStart;
   }

   public function setDistanceToStart($d)
   {
     $this->distanceToStart = $d;
   }

   public function getDurationToStart()
   {
     return $this->durationToStart;
   }

   public function setDurationToStart($duration)
   {
     $this->durationToStart = $duration;
   }

   public function getDuration()
   {
     return $this->duration;
   }//end of getDuration

   public function setDuration($seconds)
   {
     $this->duration = $seconds;
   }//end of setDuration

   public function getDisplayDuration()
   {
     $minutes =(int)($this->duration/60);
     $minutes = $minutes . " min";
     return $minutes;
   }

   public function getYelpId()
   {
     return $this->yelp_id;
   }//end of getYelpId

   public function setYelpId($id)
   {
     $this->yelp_id = $id;
   }//end of setYelpId

   public function getAddress()
   {
     return $this->address;
   }//end of getAddress

   public function setAddress($add)
   {
     $this->address = $add;
   }//end of setAddress

   public function getBusinessName()
   {
     return $this->business_name;
   }//end of getBusinessName

   public function setBusinessName($name)
   {
     $this->business_name = $name;
   }//end of setBusinessName

   public function getYelpUrl()
   {
     return $this->yelp_url;
   }//end of getYelpUrl

   public function setYelpUrl($url)
   {
     $this->yelp_url = $url;
   }//end of setYelpUrl

   public function getDisplayPrice()
   {
     return $this->display_price;
   }//end of getPrice

   public function getPriceEstimate()
   {
     return $this->price_estimate;
   }//end of getPriceEstimate

   public function setPriceEstimate($price)
   {
     $this->price_estimate = $price;
   }


   /*
     YELP'S BUDGET BREAKDOWN:
     $ = under $10,
     $$ = $11 - $30,
     $$$ = $31 - $60
     $$$$ = above $61
   */
   public function setDisplayPrice($price)
   {
     $this->display_price = $price;
     if( strcasecmp("$", $price)==0 ){
       $this->price_estimate= random_int(1, 10);
     }else if( strcasecmp("$$", $price)==0 ){
       $this->price_estimate= random_int(11, 30);
     }else if( strcasecmp("$$$", $price)==0 ){
       $this->price_estimate= random_int(31, 60);
     }else{
       $this->price_estimate= random_int(61, 100);
     }
   }//end of setPrice

   public function setRating($rating)
   {
     $this->rating = $rating;
   }//end of setRating

   public function getRating()
   {
     return $this->rating;
   }//end of getRating

   public function setLatitude($latitude)
   {
     $this->latitude = $latitude;
   }//end of setLatitude

   public function getLatitude()
   {
     return $this->latitude;
   }//end of getLatitude

   public function setLongitude($longitude)
   {
     $this->longitude = $longitude;
   }//end of longitude

   public function getLongitude()
   {
     return $this->longitude;
   }//end of getLongitude

   public function setImageUrl($url)
   {
     $this->image_url = $url;
   }//end of setImageUrl

   public function getImageUrl()
   {
     return $this->image_url;
   }//end of getImageUrl

   public function setReviewCount($count)
   {
     $this->review_count = $count;
   }//end of setReviewCount

   public function getReviewCount()
   {
     return $this->review_count;
   }//end of getReviewCount

   public function setPhone($phone)
   {
     $this->phone = $phone;
   }//end of setPhone

   public function getPhone()
   {
     return $this->phone;
   }

   public function expose()
   {
    return get_object_vars($this);
   }

}//end of business

?>
