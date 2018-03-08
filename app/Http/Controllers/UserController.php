<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = DB::table('users')->get();

        return view('admin/user/index', ['user' => $user]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        return view('admin/user/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validateItems($request);

        DB::table('users')
            ->where('id', $id)
            ->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
            ]);


        return redirect('admin/user/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
    }


    //funzione per assegnare gruppi
    public function showAssignment($id){

        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        $group = DB::table('groups')
            ->get();

        return view('admin/user/assign', ['user' => $user], ['group' => $group]);

    }

    public function saveAssignment(Request $request){

        DB::table('users_groups')
            ->insert([
                'user_id'          => $request['user_id'],
                'group_id'         => $request['group_id'],
            ]);

        return redirect('admin/user/index');

    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
        ]);
    }
}
