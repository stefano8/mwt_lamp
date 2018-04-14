<?php

namespace App\Http\Controllers;

use App\Advice;
use App\Event;
use App\Group;
use App\Itinerary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdviceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    //backend

    public function index()
    {


        $permission = $this->authentication();

        if($permission){

            $advice = Advice::paginate(10);

            return view('admin/advice/index', ['advice' => $advice]);

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

            return view('admin/advice/create');

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

            DB::table('advices')
                ->insert([
                    'title'         => $request['title'],
                    'body'          => $request['body'],
                    'description'   => $request['description'],
                    'created_at'    => now()
                ]);

            flash('Success')->success();

            return redirect('admin/advice/index');

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }


    public function delete($id)
    {


        $permission = $this->authentication();

        if($permission){
            DB::table('advices')
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

            $advice = DB::table('advices')
                ->where('id', $id)
                ->first();

            return view('admin/advice/edit', ['advice' => $advice]);

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

            DB::table('advices')
                ->where('id', $id)
                ->update([
                    'title'         => $request['title'],
                    'body'          => $request['body'],
                    'description'   => $request['description'],
                    'updated_at'    => now()
                ]);

            flash('Success')->success();


            return redirect('admin/advice/index');

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
            'title'         => 'required',
            'body'          => 'required',
        ]);
    }


    //frontend
    public function getAdvices(){

        $advices = DB::table('advices')->paginate(10);

        $topnews = DB::table('news')->orderBy('date','desc')->limit(5)->get();

        $itinerary = DB::table('itineraries')->limit(10)->get();

        $category = DB::table('categories')->get();

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

            return View::make('advices')
                ->with('advices', $advices)
                ->with('user', $user)
                ->with('itinerary', $itinerary)
                ->with('topnews', $topnews)
                ->with('category', $category)
                ->with('permission', $permission);

        } else{

            return View::make('advices')
                ->with('advices', $advices)
                ->with('topnews', $topnews)
                ->with('itinerary', $itinerary)
                ->with('category', $category);

        }
    }

    public function singleAdvice($id){


        $advices = Advice::find($id);

        $itinerary = DB::table('itineraries')->limit(10)->get();

        $category = DB::table('categories')->get();

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

            return View::make('singleAdvice')
                ->with('advices', $advices)
                ->with('user', $user)
                ->with('itinerary', $itinerary)
                ->with('category', $category)
                ->with('permission', $permission);

        } else{

            return View::make('singleAdvice')
                ->with('advices', $advices)
                ->with('itinerary', $itinerary)
                ->with('category', $category);

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
