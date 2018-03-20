<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

   class CategoryController extends Controller
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
               $category = Category::paginate(10);

               return view('admin/category/index', ['category' => $category]);
           }


           public function create()
           {

               return view('admin/category/create');
           }


           public function save(Request $request)
           {

               $this->validateItems($request);

               DB::table('categories')
                   ->insert([
                       'name'           => $request['name'],
                       'description'    => $request['description'],
                       'created_at'     => now(),
                   ]);

               return redirect('admin/category/index');

           }


           public function delete($id)
           {

               DB::table('categories')
                   ->where('id', $id)
                   ->delete();

               return redirect()->back();


           }


           public function edit($id)
           {
               $category = DB::table('categories')
                   ->where('id', $id)
                   ->first();

               return view('admin/category/edit', ['category' => $category]);
           }


           public function store($id, Request $request)
           {
               $this->validateItems($request);

               DB::table('categories')
                   ->where('id', $id)
                   ->update([
                       'name'          => $request['name'],
                       'description'   => $request['description'],
                       'update_at'     => now(),
                   ]);


               return redirect('admin/category/index');
           }


           public function validateItems(Request $request)
           {
               $this->validate($request, [
                   'name'          => 'required',
                   'description'   => 'required',
               ]);
           }



       }



