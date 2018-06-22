<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'itineraries';

    protected $fillable = [
        'id', 'name', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','created_at','updated_at'
    ];

    //un news per un itinerario
    public function itineraryNews(){

        return $this->belongsTo('App\Itinerary', 'itinerary_id');

    }
}
