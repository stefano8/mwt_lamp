<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //backend

    public function index()
    {


        $permission = $this->authentication();

        if($permission){

            $region = DB::table('regions')->get();

            return view('admin/region/index', ['region' => $region]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

    }



    public function authentication(){

        $permission = false;

        if(Auth::check()){

            $id = Auth::user()->id;

            $user = User::find($id);

            if(isset($user->groupRel)){

                foreach ($user->groupRel as $item) {

                    $group = Group::all()->where('id', $item->pivot->group_id)->first();

                    if ($group->name == 'admin') {

                        $permission = true;

                    }
                }

            }
        }

        return $permission;

    }
}
