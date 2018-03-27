<?php

namespace App\Http\Controllers;

use App\Group;
use App\Itinerary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $var = $this->authentication();

        if($var){

            return view('home');

        }else{

            return view('auth.login');
        }

    }

    //se sono autenticato e sono admin allora metto permission a true e vado sulla home admin
    //altrimenti se non sono admin torno al login
    //non bisogna usare la stessa variabile permission

    public function authentication(){

        $permission = false;

        if(Auth::check()){

            $id = Auth::user()->id;

            $user = User::find($id);

            if(isset($user->groupRel)){

                foreach ($user->groupRel as $item)

                    $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;

                }

            }
        }

        return $permission;

    }
}