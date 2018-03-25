<?php

namespace App\Http\Controllers;

use App\Event;
use App\Itinerary;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BaseController extends Controller
{
    public function index(){

        $itineraries = Itinerary::take(4)->get();

        $events = Event::take(3)->get();

        if(Auth::check()){

        $id = Auth::user()->id;

        $user = User::find($id);


        return \Illuminate\Support\Facades\View::make('welcome')
            ->with('itineraries', $itineraries)
            ->with('events', $events)
            ->with('user' , $user);

        }

        return \Illuminate\Support\Facades\View::make('welcome')
            ->with('itineraries', $itineraries)
            ->with('events', $events);

    }
}
