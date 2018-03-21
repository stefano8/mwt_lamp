<?php

namespace App\Http\Controllers;

use App\Image;
use App\Itinerary;
use App\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{

    public function index(){

        $itinerary = Itinerary::paginate(10);

        $image = DB::table('images')
            ->first();


        return View::make('wishlists')
            ->with('itineraries', $itinerary)
            ->with('image', $image);
    }




}
