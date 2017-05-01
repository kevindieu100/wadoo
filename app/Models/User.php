<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  public function itineraries()
  {
      return $this->hasMany('App\Itinerary');
  }
}
