<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Image;
use App\Itinerary;
use App\News;
use App\User;
use App\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
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



    //backend

    public function index()
    {

        $permission = $this->authentication();

        if($permission){

            $image = Image::paginate(10);

            return view('admin/image/index' , ['image' => $image]);

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


            return view('admin/image/create');


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

            DB::table('images')
                ->insert([
                    'title'         => $request['title'],
                    'path'          => $request['path'],
                    'created_at'    => now()
                ]);

            flash('Success')->success();

            return redirect('admin/image/index');


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

            DB::table('images')
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

            $image = DB::table('images')
                ->where('id', $id)
                ->first();

            return view('admin/image/edit', ['image' => $image]);

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

            DB::table('images')
                ->where('id', $id)
                ->update([
                    'title'         => $request['title'],
                    'path'          => $request['path'],
                    'updated_at'    => now(),
                ]);

            flash('Success')->success();

            return redirect('admin/image/index');

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
            'path'          => 'required',
        ]);
    }

    public function assignItinerary(){


        $permission = $this->authentication();

        if($permission){

            $itinerary = Itinerary::paginate(10);

            return view('admin/image/assign/itinerary' , ['itinerary' => $itinerary]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }

    public function showAssignmentItinerary($id){

        $permission = $this->authentication();

        if($permission){

            $itinerary = Itinerary::find($id);
            $imageCount = Image::all()->where('itinerary_id', '=', $id)->count();

            $image = Image::all()->where('itinerary_id', '=', $id);

            $photo = Image::all();

            //return view('admin/image/assign//assignItinerary', ['itinerary' => $itinerary], ['image' => $image], ['photo' => $photo]);
            //return route('image.showAssignmentItinerary', $itinerary, $image, $photo );
            return \View::make('admin/image/assign//assignItinerary')
                ->with('itinerary', $itinerary)
                ->with('image', $image)
                ->with('photo', $photo)
                ->with('imageCount',$imageCount);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }






    }

    //rimuove l'immagine associata ad un itinerario
    public function removeAssignmentItinerary($itinerary_id,$image_id)
    {


        $permission = $this->authentication();

        if($permission){

            DB::table('images')
                ->where('id', $image_id)
                ->where('itinerary_id', $itinerary_id)
                ->update([
                    'itinerary_id' => null
                ]);


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

    //
    public function saveAssignmentItinerary(Request $request, $itinerary_id){

        $permission = $this->authentication();

        if($permission){

            $var = $request['image'];


            DB::table('images')
                ->where('id', $var)
                ->update([
                    'itinerary_id' => $request['itinerary_id'],
                    'updated_at' => now(),
                ]);

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



    //image for User

    public function assignUser(){


        $permission = $this->authentication();

        if($permission){

            $user = User::paginate(10);

            return view('admin/image/assign/user' , ['user' => $user]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }


    public function showAssignmentUser($id){

        $permission = $this->authentication();

        if($permission){

            $user = User::find($id);
            $imageCount = Image::all()->where('user_id', '=', $id)->count();

            $image = Image::all()->where('user_id', '=', $id);

            $photo = Image::all();

            //return view('admin/image/assign//assignItinerary', ['itinerary' => $itinerary], ['image' => $image], ['photo' => $photo]);
            //return route('image.showAssignmentItinerary', $itinerary, $image, $photo );
            return \View::make('admin/image/assign/assignUser')
                ->with('user', $user)
                ->with('image', $image)
                ->with('photo', $photo)
                ->with('imageCount',$imageCount );

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }

    //rimuove l'immagine associata ad un user
    public function removeAssignmentUser($user_id,$image_id)
    {

        $permission = $this->authentication();

        if($permission){

            DB::table('images')
                ->where('id', $image_id)
                ->where('user_id', $user_id)
                ->update([
                    'user_id' => null
                ]);


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

    //
    public function saveAssignmentUser(Request $request, $user_id){


        $permission = $this->authentication();

        if($permission){

            $var = $request['image'];


            DB::table('images')
                ->where('id', $var)
                ->update([
                    'user_id' => $request['user_id'],
                    'updated_at' => now(),
                ]);

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

    //image per eventi
    public function assignEvent(){


        $permission = $this->authentication();

        if($permission){

            $event = Event::paginate(10);

            return view('admin/image/assign/event' , ['event' => $event]);
        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }


    public function showAssignmentEvent($id){

        $permission = $this->authentication();

        if($permission){

            $event = Event::find($id);


            $imageCount = Image::all()->where('event_id', '=', $id)->count();

            $image = Image::all()->where('event_id', '=', $id);

            $photo = Image::all();

            //return view('admin/image/assign//assignItinerary', ['itinerary' => $itinerary], ['image' => $image], ['photo' => $photo]);
            //return route('image.showAssignmentItinerary', $itinerary, $image, $photo );
            return \View::make('admin/image/assign/assignEvent')
                ->with('event', $event)
                ->with('image', $image)
                ->with('photo', $photo)
                ->with('imageCount',$imageCount);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }





    }

    //rimuove l'immagine associata ad un event
    public function removeAssignmentEvent($event_id,$image_id)
    {

        $permission = $this->authentication();

        if($permission){

            DB::table('images')
                ->where('id', $image_id)
                ->where('event_id', $event_id)
                ->update([
                    'event_id' => null
                ]);


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

    //
    public function saveAssignmentEvent(Request $request, $event_id){

        $permission = $this->authentication();

        if($permission){

            $var = $request['image'];


            DB::table('images')
                ->where('id', $var)
                ->update([
                    'event_id' => $request['event_id'],
                    'updated_at' => now(),
                ]);

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


    //image per news
    public function assignNews(){


        $permission = $this->authentication();

        if($permission){

            $new = News::paginate(10);

            return view('admin/image/assign/news' , ['new' => $new]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }


    public function showAssignmentNews($id){



        $permission = $this->authentication();

        if($permission){

            $new = News::find($id);

            $imageCount = Image::all()->where('new_id', '=', $id)->count();


            $image = Image::all()->where('new_id', '=', $id);

            $photo = Image::all();

            //return view('admin/image/assign//assignItinerary', ['itinerary' => $itinerary], ['image' => $image], ['photo' => $photo]);
            //return route('image.showAssignmentItinerary', $itinerary, $image, $photo );
            return \View::make('admin/image/assign/assignNews')
                ->with('new', $new)
                ->with('image', $image)
                ->with('photo', $photo)
                ->with('imageCount', $imageCount);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }


    }

    //rimuove l'immagine associata ad un news
    public function removeAssignmentNews($new_id,$image_id)
    {


        $permission = $this->authentication();

        if($permission){
            DB::table('images')
                ->where('id', $image_id)
                ->where('new_id', $new_id)
                ->update([
                    'new_id' => null
                ]);


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



    //
    public function saveAssignmentNews(Request $request, $new_id){

        $permission = $this->authentication();

        if($permission){

            $var = $request['image'];

            DB::table('images')
                ->where('id', $var)
                ->update([
                    'new_id' => $request['new_id'],
                    'updated_at' => now(),
                ]);

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
