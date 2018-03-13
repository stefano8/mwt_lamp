<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItineraryCategory extends Model
{
    protected $table = 'itineraries_categories';

    protected $fillable = [
        'id','itinerary_id', 'category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
