<?php
/**
 * Created by PhpStorm.
 * User: stefanocorsetti
 * Date: 02/03/18
 * Time: 15:04
 */

namespace App\Http\Controllers;

use App\Image;
use App\Itinerary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ItineraryController extends Controller
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
        $itinerary = DB::table('itineraries')->get();

        return view('admin/itinerary/index', ['itinerary' => $itinerary]);
    }


    public function create()
    {

        return view('admin/itinerary/create');
    }


    public function save(Request $request)
    {

        $this->validateItems($request);

        DB::table('itineraries')
            ->insert([
                'name'          => $request['name'],
                'difficolty'    => $request['difficolty'],
                'difference'    => $request['difference'],
                'description'   => $request['description'],
                'duration'      => $request['duration'],
                'created_at'    => now()
            ]);

        return redirect('admin/itinerary/index');

    }


    public function delete($id)
    {

        DB::table('itineraries')
            ->where('id', $id)
            ->delete();

        return redirect()->back();


    }


    public function edit($id)
    {
        $itinerary = DB::table('itineraries')
            ->where('id', $id)
            ->first();

        return view('admin/itinerary/edit', ['itinerary' => $itinerary]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('itineraries')
            ->where('id', $id)
            ->update([
                'name'          => $request['name'],
                'difficolty'    => $request['difficolty'],
                'difference'    => $request['difference'],
                'description'   => $request['description'],
                'duration'      => $request['duration'],
                'updated_at'    => now()
            ]);


        return redirect('admin/itinerary/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'difficolty'    => 'required',
            'difference'    => 'required',
            'description'   => 'required',
            'duration'      => 'required',
        ]);
    }

    //frontend

    public function getItineraries($id)
    {

        $itinerary = DB::table('itineraries')
            ->get();


        $image = DB::table('images')
            //->where('itinerary_id', '=', 1)
            ->first();

        /*return View::make('live-cameras')
            ->with('itineraries', $itinerary)
            ->with('images', $image);
         */
        return view('live-cameras', ['itineraries' => $itinerary], ['image' => $image]);

    }


    public function singleItinerary($id)
    {

        $itinerary = DB::table('itineraries')
            ->where('id', $id)->first();

        $review = DB::table('reviews')
            ->where('approved', 1)
            ->where('itinerary_id','=', $id)
            ->get();

        $image = DB::table('images')
            ->where('itinerary_id', '=' , $id)->get();

        return View::make('single')
            ->with('itinerary', $itinerary)
            ->with('review', $review)
            ->with('image', $image);

    }

}


