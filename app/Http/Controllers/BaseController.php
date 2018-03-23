<?php

namespace App\Http\Controllers;

use App\Event;
use App\Itinerary;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index(){

        $itineraries = Itinerary::take(4)->get();

        $events = Event::take(3)->get();

        return view('welcome', ['itineraries' => $itineraries],['events' => $events] );

    }
}
