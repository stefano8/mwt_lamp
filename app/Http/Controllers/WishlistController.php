<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{

    public function index(){

        $itineraries = DB::table('itineraries')->get();

        $image = DB::table('images')->first();

        return view('wishlist', ['itineraries'=>$itineraries], ['image'=>$image]);
    }


}
