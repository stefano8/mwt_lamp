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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itinerary = DB::table('itinerary')->get();

        return view('admin/itinerary/index', ['itinerary' => $itinerary]);
    }


    public function create(){

        return view('admin/itinerary/create');
    }


    public function save(Request $request){

        $this->validateItems($request);

        $itinerary = DB::table('itinerary')
                    ->insert([
                        'name'       => $request['name'],
                        'difficolty' => $request['difficolty'],
                        'difference' => $request['difference'],
                    ]);


        return redirect('admin/itinerary/index');

    }

    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name'            => 'required',
            'difficolty'      => 'required',
            'difference'      => 'required',
        ]);
    }

    public function getItinerari(){

        $itinerari = DB::table('itinerary')->get();

        return View::make('live-cameras')->with('itineraries', $itinerari);

    }

    public function singleItinerario($id){

        $itinerario = DB::table('itinerary')->where('id', $id)->first();

        return View::make('single')->with('itinerary', $itinerario);
    }

}


