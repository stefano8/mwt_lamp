<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'itinerary_id'
    ];


    //una Categoria N Itinerary
    public function itineraryRel()
    {
        return $this->belongsToMany('App\Itinerary', 'itineraries_categories')->withPivot('id', 'itinerary_id', 'category_id');
    }
}
