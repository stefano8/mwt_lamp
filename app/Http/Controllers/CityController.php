<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    //backend

    public function index()
    {
        $city = DB::table('cities')->paginate(10);

        return view('admin/city/index', ['city' => $city]);
    }


    public function create()

    {
        $region = DB::table('regions')->get();

        return view('admin/city/create', ['region' => $region]);
    }


    public function save(Request $request)
    {
        $this->validateItems($request);

        DB::table('cities')
            ->insert([
                'name'              => $request['name'],
                'region_id'         => $request['region_id'],  //il valore della selectbox
                'created_at'        => now()
            ]);

        flash('Success')->success();

        return redirect('admin/city/index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('cities')
            ->where('id', $id)
            ->delete();

        flash('Deleted')->error();

        return redirect()->back();
    }

    public function edit($id)
    {
        $city = DB::table('cities')
            ->select('*')
            ->where('id', $id)
            ->first();

        $region = DB::table('regions')
            ->get();



        return view('admin/city/edit', ['city' => $city], ['region' => $region]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('cities')
            ->where('id', $id)
            ->update([
                'name'              => $request['name'],
                'region_id'         => $request['reg'],
                'updated_at'        => now(),
            ]);

        flash('Success')->success();

        return redirect('admin/city/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'region_id'     => 'required',
        ]);
    }


}

