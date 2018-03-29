<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{

    //backend

    public function index()
    {

        $permission = $this->authentication();

        if($permission){

            $city = DB::table('cities')->paginate(10);

            return view('admin/city/index', ['city' => $city]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

    }


    public function create()
    {

        $permission = $this->authentication();

        if($permission){

            $region = DB::table('regions')->get();

            return view('admin/city/create', ['region' => $region]);
        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }


    }


    public function save(Request $request)
    {

        $permission = $this->authentication();

        if($permission){

            $this->validateItems($request);

            DB::table('cities')
                ->insert([
                    'name'              => $request['name'],
                    'region_id'         => $request['region_id'],  //il valore della selectbox
                    'created_at'        => now()
                ]);

            flash('Success')->success();

            return redirect('admin/city/index');

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $permission = $this->authentication();

        if($permission){

            DB::table('cities')
                ->where('id', $id)
                ->delete();

            flash('Deleted')->error();

            return redirect()->back();

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

    }

    public function edit($id)
    {

        $permission = $this->authentication();

        if($permission){

            $city = DB::table('cities')
                ->select('*')
                ->where('id', $id)
                ->first();

            $region = DB::table('regions')
                ->get();



            return view('admin/city/edit', ['city' => $city], ['region' => $region]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }


    }


    public function store($id, Request $request)
    {

        $permission = $this->authentication();

        if($permission){

            $this->validateItems($request);

            DB::table('cities')
                ->where('id', $id)
                ->update([
                    'name'              => $request['name'],
                    'region_id'         => $request['reg'],
                    'updated_at'        => now(),
                ]);

            flash('Success')->success();

            return redirect('admin/city/index');

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }


    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'region_id'     => 'required',
        ]);
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

