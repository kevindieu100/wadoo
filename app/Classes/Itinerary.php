<?php

namespace App\Classes;

// base class with member properties and methods
class Itinerary {
  public $experiences = array(); //the array of experiences
  public $id;
  public $budgetPreference;
  public $displayBudgetPreference;
  public $durationPreference;
  public $displayDurationPreference;
  public $totalBudget;
  public $displayBudget;
  public $totalDuration;
  public $displayDuration;
  public $title;

  public function __construct($experiences, $budgetPreference, $durationPreference, $totalBudget, $totalDuration)
  {
    $this->title = "Your Itinerary";
    $this->experiences = $experiences;
    $this->budgetPreference = $budgetPreference;
    $this->displayBudgetPreference = '$' . $budgetPreference;
    $this->durationPreference = $durationPreference;
    $this->displayDurationPreference = $this->getDisplayDurationPreference();
    $this->totalBudget = $totalBudget;
    $this->displayBudget = '$' . $totalBudget;
    $this->totalDuration = $totalDuration;
    $this->displayDuration = $this->getDisplayDuration();
  }

  public function getDisplayDurationPreference()
  {
    $seconds = $this->durationPreference;
    $hours = floor($seconds / 3600);
    $seconds -= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;
    if($hours == 0){
      return $minutes . "min";
    }
    else{
      return $hours . "hr " . $minutes . "min";
    }
  }

  public function getDisplayDuration()
  {
    $seconds = $this->totalDuration;
    $hours = floor($seconds / 3600);
    $seconds -= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;
    if($hours == 0){
      return $minutes . "min";
    }
    else{
      return $hours . "hr " . $minutes . "min";
    }
  }

  public function getDisplayBudget()
  {
    return "$" . $this->totalBudget;
  }
}

?>
