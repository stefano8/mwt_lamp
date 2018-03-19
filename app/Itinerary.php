<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $table = 'itineraries';

    protected $fillable = [
        'id', 'name', 'difficolty', 'difference', 'duration', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','created_at','updated_at'
    ];

    //un itinerario appartiene alla wishlist di più utenti
    public function toPossess(){

            return $this->belongsToMany('App\User', 'wishlists')->withPivot('id', 'user_id', 'itinerary_id');

    }

    //view
    public function itineraryView(){

        return $this->belongsToMany('App\User', 'views')->withPivot('id', 'user_id', 'itinerary_id');

    }


    //un Itinerario N Eventi
    public function eventRel(){

        return $this->hasMany('App\Event');

    }

    //un Itinerario appartiene a più Categorie
    public function categoryRel(){

            return $this->belongsToMany('App\Category','itineraries_categories')->withPivot('id','category_id', 'itinerary_id');

    }

    //un itinerario n voti
    public function itineraryVote(){

        return $this->hasMany('App\Vote');

    }

    //un Itinerario N image
    public function itineraryImage(){

        return $this->hasMany('App\Image', 'itinerary_id');

    }

    //un news per un itinerario
    public function itineraryNews(){

        return $this->belongsTo('App\News');

    }



}
