<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'body', 'date'
    ];


    //una news una image
    public function newsImage(){

        return $this->hasOne('App\Image');


    }

    //una news un itinerario
    public function newsItinerary(){

        return $this->hasOne('App\Itinerary');


    }
}
