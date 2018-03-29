<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    //backend

    public function index()
    {
        $event = Event::paginate(10);
        $permission = $this->authentication();

        if($permission){

            return view('admin/event/index', ['event' => $event]);
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

            $itinerary = DB::table('itineraries')->get();

            return view('admin/event/create', ['itinerary' => $itinerary]);
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

            DB::table('events')
                ->insert([
                    'date' => now(),
                    'title' => $request['title'],
                    'body' => $request['body'],
                    'address' => $request['address'],
                    'description' => $request['description'],
                    'itinerary_id' => $request['itinerary_id'],  //il valore della selectbox
                    'created_at' => now()
                ]);

            flash('Success')->success();

            return redirect('admin/event/index');

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $permission = $this->authentication();

        if($permission){

            DB::table('events')
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

            $event = DB::table('events')
                ->select('*')
                ->where('id', $id)
                ->first();

            $itinerary = DB::table('itineraries')
                ->get();


            return view('admin/event/edit', ['event' => $event], ['itinerary' => $itinerary]);

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

            DB::table('events')
                ->where('id', $id)
                ->update([
                    'title' => $request['title'],
                    'body' => $request['body'],
                    'address' => $request['address'],
                    'description' => $request['description'],
                    'itinerary_id' => $request['itinerary_id'],
                    'updated_at' => now(),
                ]);

            flash('Success')->success();

            return redirect('admin/event/index');
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
            'title' => 'required',
            'body' => 'required',
            'address' => 'required',
            'description' => 'required',
            'itinerary_id' => 'required',
        ]);
    }


    public function getEvent()
    {
        $permission = false;
        $event = DB::table('events')->get();

        if (Auth::check()) {

            $id = Auth::user()->id;

            $user = User::find($id);



            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }

            return \Illuminate\Support\Facades\View::make('events')
                ->with('event', $event)
                ->with('user', $user)
                ->with('permission', $permission);


        } else {

            return view('events', ['event' => $event]);
        }

    }

    public function singleEvent($id){

        $event = Event::find($id);
        $permission = false;

        if (Auth::check()) {

            $id = Auth::user()->id;

            $user = User::find($id);



            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }

            return \Illuminate\Support\Facades\View::make('singleEvent')
                ->with('event', $event)
                ->with('user', $user)
                ->with('permission', $permission);


        } else {

            return view('singleEvent', ['event' => $event]);

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
