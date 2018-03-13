<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //relazione molti a molti con Group
    public function groupRel()
    {
        return $this->belongsToMany('App\Group', 'users_groups')->withPivot('id', 'group_id', 'user_id');
    }



    //relazione uno a molti con Review
    public function writeReview(){

        return $this->hasMany('App\Review');

    }


    //un utente n itinerary (wishlist)
    public function wishlistRel(){

        return $this->belongsToMany('App\Itinerary','wishlists', 'itinerary_id', 'user_id');

    }

    //view
    public function viewRel(){

        return $this->belongsToMany('App\Itinerary','views', 'itinerary_id', 'user_id');

    }

    //un utente un voto a più itinerari

    public function voteRel()
    {



    }





}
