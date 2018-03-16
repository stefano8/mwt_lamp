<?php

namespace App\Http\Controllers;

use App\Image;
use App\Itinerary;
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
        $image = Image::all();



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

        return redirect('admin/image/index');

    }


    public function delete($id)
    {

        DB::table('images')
            ->where('id', $id)
            ->delete();

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

        $itinerary = Itinerary::all();

        return view('admin/image/assign/itinerary' , ['itinerary' => $itinerary]);

    }

    public function showAssignmentItinerary($id){

        $itinerary = Itinerary::find($id);

        $image = Image::all()->where('itinerary_id', '=', $id);

        $photo = Image::all();

        //return view('admin/image/assign//assignItinerary', ['itinerary' => $itinerary], ['image' => $image], ['photo' => $photo]);
        //return route('image.showAssignmentItinerary', $itinerary, $image, $photo );
        return \View::make('admin/image/assign//assignItinerary')
                    ->with('itinerary', $itinerary)
                    ->with('image', $image)
                    ->with('photo', $photo);


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

}
