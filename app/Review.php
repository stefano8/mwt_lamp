<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Review extends Model
{
    use Notifiable;

    protected $table = 'reviews';

    protected $fillable = [
        'id', 'approved', 'body', 'date', 'title'
    ];

    //relazione uno a molti con User (una recensione è scritta da un utente)
    public function writeUser(){

        return $this->belongsTo('App\User');

    }



}
