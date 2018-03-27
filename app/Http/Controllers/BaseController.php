<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BaseController extends Controller
{
    public function index()
    {

        $itineraries = Itinerary::take(4)->get();

        $events = Event::take(3)->get();
        $permission = false;

        //controllo se utente loggato con piu di un gruppo assocciato e uno di questi è admin allora
        //mi setta la variabile permission a true usata nel blade (per controllo bottone dashboard)

        if (Auth::check()) {

            $id = Auth::user()->id;

            $user = User::find($id);



            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }

            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('itineraries', $itineraries)
                ->with('events', $events)
                ->with('user', $user)
                ->with('permission', $permission);

        }  //se non sei loggato

        return \Illuminate\Support\Facades\View::make('welcome')
            ->with('itineraries', $itineraries)
            ->with('events', $events);

    }


}
