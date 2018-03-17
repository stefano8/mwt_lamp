<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdviceController extends Controller
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
        $advice = DB::table('advices')->get();

        return view('admin/advice/index', ['advice' => $advice]);
    }


    public function create()
    {

        return view('admin/advice/create');
    }


    public function save(Request $request)
    {

        $this->validateItems($request);

        DB::table('advices')
            ->insert([
                'title'         => $request['title'],
                'body'          => $request['body'],
                'description'   => $request['description'],
                'created_at'    => now()
            ]);

        return redirect('admin/advice/index');

    }


    public function delete($id)
    {

        DB::table('advices')
            ->where('id', $id)
            ->delete();

        return redirect()->back();


    }


    public function edit($id)
    {
        $advice = DB::table('advices')
            ->where('id', $id)
            ->first();

        return view('admin/advice/edit', ['advice' => $advice]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('advices')
            ->where('id', $id)
            ->update([
                'title'         => $request['title'],
                'body'          => $request['body'],
                'description'   => $request['description'],
                'updated_at'    => now()
            ]);


        return redirect('admin/advice/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'body'          => 'required',
            'description'   => 'required',
        ]);
    }
}