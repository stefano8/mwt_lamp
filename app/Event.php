<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $table = 'events';

    protected $fillable = [
        'id', 'title', 'description', 'date', 'address', 'body'
    ];


    //un Evento per un Itinerario
    public function itineraryRel(){

        return $this->belongsTo('App\User');

    }

    //un Evento per una image
    public function eventImage(){

        return $this->hasOne('App\Image');

    }

}
