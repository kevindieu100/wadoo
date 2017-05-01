<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'itineraries';

  /**
 * Indicates if the model should be timestamped.
 *
 * @var bool
 */
  public $timestamps = false;

  protected $fillable = array('title');

  public function experiences()
  {
      return $this->hasMany('App\Experience');
  }

  public function delete()
  {
      // delete all related photos
      $this->experiences()->delete();
      // as suggested by Dirk in comment,
      // it's an uglier alternative, but faster
      // Photo::where("user_id", $this->id)->delete()

      // delete itinerary
      return parent::delete();
  }
}
