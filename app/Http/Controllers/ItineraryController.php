<?php
/**
 * Created by PhpStorm.
 * User: stefanocorsetti
 * Date: 02/03/18
 * Time: 15:04
 */

namespace App\Http\Controllers;

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
        $itinerary = DB::table('itinerary')->get();

        return view('admin/itinerary/index', ['itinerary' => $itinerary]);
    }


    public function create()
    {

        return view('admin/itinerary/create');
    }


    public function save(Request $request)
    {

        $this->validateItems($request);

        DB::table('itinerary')
            ->insert([
                'name'          => $request['name'],
                'difficolty'    => $request['difficolty'],
                'difference'    => $request['difference'],
                'description'   => $request['description'],
            ]);

        return redirect('admin/itinerary/index');

    }


    public function delete($id)
    {

        DB::table('itinerary')
            ->where('id', $id)
            ->delete();

        return redirect()->back();


    }


    public function edit($id)
    {
        $itinerary = DB::table('itinerary')
            ->where('id', $id)
            ->first();

        return view('admin/itinerary/edit', ['itinerary' => $itinerary]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('itinerary')
            ->where('id', $id)
            ->update([
                'name'          => $request['name'],
                'difficolty'    => $request['difficolty'],
                'difference'    => $request['difference'],
                'description'   => $request['description'],
            ]);


        return redirect('admin/itinerary/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'difficolty'    => 'required',
            'difference'    => 'required',
            'description'   => 'required',
        ]);
    }

    //frontend

    public function getItineraries()
    {

        $itinerari = DB::table('itinerary')->get();

        return View::make('live-cameras')
            ->with('itineraries', $itinerari);

    }

    public function singleItinerary($id)
    {

        $itinerario = DB::table('itinerary')
            ->where('id', $id)->first();

        return View::make('single')
            ->with('itinerary', $itinerario);
    }

}


