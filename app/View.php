<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table='views';


    protected $fillable = [
        'id','itinerary_id', 'user_id'
    ];

}
