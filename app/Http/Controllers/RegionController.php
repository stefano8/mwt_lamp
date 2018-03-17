<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //backend

    public function index()
    {
        $region = DB::table('regions')->get();

        return view('admin/region/index', ['region' => $region]);
    }

}
