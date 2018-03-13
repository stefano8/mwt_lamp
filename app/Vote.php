<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table='votes';


    protected $fillable = [
        'id','itinerary_id','vote'
    ];

    //un voto per un itinerario
    public function voteRel(){

        return $this->belongsTo('App\Itinerary');

    }




}
