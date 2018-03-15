<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
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
        $group = DB::table('groups')->get();

        return view('admin/group/index', ['group' => $group]);
    }


    public function create()
    {

        return view('admin/group/create');
    }


    public function save(Request $request)
    {

        $this->validateItems($request);

        DB::table('groups')
            ->insert([
                'name'          => $request['name'],
                'description'   => $request['description'],
                'created_at'    => now()
            ]);

        return redirect('admin/group/index');

    }


    public function delete($id)
    {

        DB::table('groups')
            ->where('id', $id)
            ->delete();

        return redirect()->back();


    }


    public function edit($id)
    {
        $group = DB::table('groups')
            ->where('id', $id)
            ->first();

        return view('admin/group/edit', ['group' => $group]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('groups')
            ->where('id', $id)
            ->update([
                'name'          => $request['name'],
                'description'   => $request['description'],
                'updated_at'    => now()
            ]);


        return redirect('admin/group/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description'   => 'required',
        ]);
    }
}
