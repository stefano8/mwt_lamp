<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'path', 'title', 'itinerary_id'
    ];


    //relazione uno a uno con User
    public function imageUser()
    {
        return $this->belongsTo('App\User');
    }

    //un itinerario piu immagini
    public function imageItinerary(){

        return $this->belongsTo('App\Itinerary');
    }

    //relazione uno a uno con News
    public function imageNews()
    {
        return $this->belongsTo('App\News');
    }

    //relazione uno a uno con Event
    public function imageEvent()
    {
        return $this->hasOne('App\Event');
    }

}
