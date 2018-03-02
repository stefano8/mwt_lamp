<?php
/**
 * Created by PhpStorm.
 * User: stefanocorsetti
 * Date: 02/03/18
 * Time: 15:04
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AggiungiItinerariController extends Controller
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
        return view('admin/aggiungi-itinerari');
    }
}

