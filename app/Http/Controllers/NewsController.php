<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\News;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Jorenvh\Share\Share;

class NewsController extends Controller
{

    //backend

    public function index()
    {

        $permission = $this->authentication();

        if($permission){

            $news = News::paginate(10);

            return view('admin/news/index', ['news' => $news]);
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

            return view('admin/news/create', ['itinerary' => $itinerary]);

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

            DB::table('news')
                ->insert([
                    'date'              => now(),
                    'title'             => $request['title'],
                    'body'              => $request['body'],
                    'itinerary_id'      => $request['itinerary_id'],  //il valore della selectbox
                    'created_at'        => now()
                ]);

            flash('Success')->success();

            return redirect('admin/news/index');


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


            DB::table('images')
                ->where('new_id','=', $id)
                ->delete();


            DB::table('news')
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


            $news = DB::table('news')
                ->select('*')
                ->where('id', $id)
                ->first();

            $itinerary = DB::table('itineraries')
                ->get();



            return view('admin/news/edit', ['news' => $news], ['itinerary' => $itinerary]);


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

            DB::table('news')
                ->where('id', $id)
                ->update([
                    'title'             => $request['title'],
                    'body'              => $request['body'],
                    'itinerary_id'      => $request['itinerary_id'],
                    'updated_at'        => now(),
                ]);

            flash('Success')->success();


            return redirect('admin/news/index');


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
            'itinerary_id'  => 'required',
        ]);
    }


    public function getNews(){

        $news = DB::table('news')->orderBy('date','desc')->paginate(6);

        $topnews = DB::table('news')->orderBy('date','desc')->limit(5)->get();

        $itinerary = DB::table('itineraries')->limit(10)->get();

        $category = DB::table('categories')->get();


        if (Auth::check()) {

            $id = Auth::user()->id;

            $user = User::find($id);

            $permission = false;

            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }

            return View::make('news')
                ->with('news', $news)
                ->with('user', $user)
                ->with('itinerary', $itinerary)
                ->with('topnews', $topnews)
                ->with('category', $category)
                ->with('permission', $permission);

        } else{

            return View::make('news')
                ->with('news', $news)
                ->with('topnews', $topnews)
                ->with('itinerary', $itinerary)
                ->with('category', $category);

        }


    }


    public function singleNews($id){

        $news = News::find($id);

        $image = DB::table('images')->where('new_id', $id)->get();

        $itinerary = DB::table('itineraries')->limit(10)->get();

        $event = DB::table('events')->limit(5)->get();

        $category = DB::table('categories')->limit(5)->get();

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
            return \Illuminate\Support\Facades\View::make('singleNews')
                ->with('news', $news)
                ->with('user', $user)
                ->with('itinerary', $itinerary)
                ->with('image', $image)
                ->with('event', $event)
                ->with('permission', $permission)
                ->with('category' , $category);
        }else {

            return \Illuminate\Support\Facades\View::make('singleNews')
                ->with('image', $image)
                ->with('itinerary', $itinerary)
                ->with('event', $event)
                ->with('news', $news)
                ->with('category' , $category);
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
