<?php

namespace App\Http\Controllers;

use App\Event;
use App\Image;
use App\Itinerary;
use App\News;
use App\User;
use App\View;
use Illuminate\Http\Request;
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
        $image = Image::paginate(10);

        return view('admin/image/index' , ['image' => $image]);
    }

    public function create()
    {
        return view('admin/image/create');
    }


    public function save(Request $request)
    {

        $this->validateItems($request);

        DB::table('images')
            ->insert([
                'title'         => $request['title'],
                'path'          => $request['path'],
                'created_at'    => now()
            ]);

        flash('Success')->success();

        return redirect('admin/image/index');

    }


    public function delete($id)
    {

        DB::table('images')
            ->where('id', $id)
            ->delete();

        flash('Deleted')->error();

        return redirect()->back();


    }


    public function edit($id)
    {
        $image = DB::table('images')
            ->where('id', $id)
            ->first();

        return view('admin/image/edit', ['image' => $image]);
    }


    public function store($id, Request $request)
    {
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
    }

    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'path'          => 'required',
        ]);
    }

    public function assignItinerary(){

        $itinerary = Itinerary::paginate(10);

        return view('admin/image/assign/itinerary' , ['itinerary' => $itinerary]);

    }

    public function showAssignmentItinerary($id){

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


    }

    //rimuove l'immagine associata ad un itinerario
    public function removeAssignmentItinerary($itinerary_id,$image_id)
    {


        DB::table('images')
            ->where('id', $image_id)
            ->where('itinerary_id', $itinerary_id)
            ->update([
                'itinerary_id' => null
            ]);


        return redirect()->back();
    }

    //
    public function saveAssignmentItinerary(Request $request, $itinerary_id){

        $var = $request['image'];


        foreach ($var as $value) {

            DB::table('images')
                ->where('id', $value)
                ->update([
                    'itinerary_id' => $request['itinerary_id'],
                    'updated_at' => now(),
                ]);
        }
        return redirect()->back();


    }



    //image for User

    public function assignUser(){

        $user = User::paginate(10);

        return view('admin/image/assign/user' , ['user' => $user]);

    }


    public function showAssignmentUser($id){

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


    }

    //rimuove l'immagine associata ad un user
    public function removeAssignmentUser($user_id,$image_id)
    {


        DB::table('images')
            ->where('id', $image_id)
            ->where('user_id', $user_id)
            ->update([
                'user_id' => null
            ]);


        return redirect()->back();
    }

    //
    public function saveAssignmentUser(Request $request, $user_id){

        $var = $request['image'];


            DB::table('images')
                ->where('id', $var)
                ->update([
                    'user_id' => $request['user_id'],
                    'updated_at' => now(),
                ]);

        return redirect()->back();


    }

    //image per eventi
    public function assignEvent(){

        $event = Event::paginate(10);

        return view('admin/image/assign/event' , ['event' => $event]);

    }


    public function showAssignmentEvent($id){

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


    }

    //rimuove l'immagine associata ad un event
    public function removeAssignmentEvent($event_id,$image_id)
    {


        DB::table('images')
            ->where('id', $image_id)
            ->where('event_id', $event_id)
            ->update([
                'event_id' => null
            ]);


        return redirect()->back();
    }

    //
    public function saveAssignmentEvent(Request $request, $event_id){

        $var = $request['image'];


            DB::table('images')
                ->where('id', $var)
                ->update([
                    'event_id' => $request['event_id'],
                    'updated_at' => now(),
                ]);

        return redirect()->back();


    }


    //image per news
    public function assignNews(){

        $new = News::paginate(10);

        return view('admin/image/assign/news' , ['new' => $new]);

    }


    public function showAssignmentNews($id){

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


    }

    //rimuove l'immagine associata ad un news
    public function removeAssignmentNews($new_id,$image_id)
    {


        DB::table('images')
            ->where('id', $image_id)
            ->where('new_id', $new_id)
            ->update([
                'new_id' => null
            ]);


        return redirect()->back();
    }

    //
    public function saveAssignmentNews(Request $request, $new_id){

        $var = $request['image'];

            DB::table('images')
                ->where('id', $var)
                ->update([
                    'new_id' => $request['new_id'],
                    'updated_at' => now(),
                ]);

        return redirect()->back();


    }




}
