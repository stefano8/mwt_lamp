<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\User;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

   class CategoryController extends Controller
   {

           /**
            * Create a new controller instance.
            *
            * @return void
            */

           //backend

           public function index()
           {

               $permission = $this->authentication();

               if($permission){

                   $category = Category::paginate(10);

                   return view('admin/category/index', ['category' => $category]);

               }else{

                   $itineraries = Itinerary::take(4)->get();
                   $events = Event::take(3)->get();
                   return \Illuminate\Support\Facades\View::make('welcome')
                       ->with('permission', $permission )
                       ->with('itineraries', $itineraries)
                       ->with('events', $events);
               }

           }


           public function create()
           {

               $permission = $this->authentication();

               if($permission){

                   return view('admin/category/create');

               }else{

                   $itineraries = Itinerary::take(4)->get();
                   $events = Event::take(3)->get();
                   return \Illuminate\Support\Facades\View::make('welcome')
                       ->with('permission', $permission )
                       ->with('itineraries', $itineraries)
                       ->with('events', $events);
               }

           }


           public function save(Request $request)
           {


               $permission = $this->authentication();

               if($permission){

                   $this->validateItems($request);

                   DB::table('categories')
                       ->insert([
                           'name'           => $request['name'],
                           'description'    => $request['description'],
                           'created_at'     => now(),
                       ]);

                   flash('Success')->success();

                   return redirect('admin/category/index');

               }else{

                   $itineraries = Itinerary::take(4)->get();
                   $events = Event::take(3)->get();
                   return \Illuminate\Support\Facades\View::make('welcome')
                       ->with('permission', $permission )
                       ->with('itineraries', $itineraries)
                       ->with('events', $events);
               }

           }


           public function delete($id)
           {

               $permission = $this->authentication();

               if($permission){

                   DB::table('categories')
                       ->where('id', $id)
                       ->delete();

                   flash('Deleted')->error();

                   return redirect()->back();

               }else{

                   $itineraries = Itinerary::take(4)->get();
                   $events = Event::take(3)->get();
                   return \Illuminate\Support\Facades\View::make('welcome')
                       ->with('permission', $permission )
                       ->with('itineraries', $itineraries)
                       ->with('events', $events);
               }


           }


           public function edit($id)
           {

               $permission = $this->authentication();

               if($permission){

                   $category = DB::table('categories')
                       ->where('id', $id)
                       ->first();

                   return view('admin/category/edit', ['category' => $category]);

               }else{

                   $itineraries = Itinerary::take(4)->get();
                   $events = Event::take(3)->get();
                   return \Illuminate\Support\Facades\View::make('welcome')
                       ->with('permission', $permission )
                       ->with('itineraries', $itineraries)
                       ->with('events', $events);
               }

           }


           public function store($id, Request $request)
           {

               $permission = $this->authentication();

               if($permission){

                   $this->validateItems($request);

                   DB::table('categories')
                       ->where('id', $id)
                       ->update([
                           'name'          => $request['name'],
                           'description'   => $request['description'],
                           'updated_at'     => now(),
                       ]);

                   flash('Success')->success();


                   return redirect('admin/category/index');

               }else{

                   $itineraries = Itinerary::take(4)->get();
                   $events = Event::take(3)->get();
                   return \Illuminate\Support\Facades\View::make('welcome')
                       ->with('permission', $permission )
                       ->with('itineraries', $itineraries)
                       ->with('events', $events);
               }

           }


           public function validateItems(Request $request)
           {
               $this->validate($request, [
                   'name'          => 'required',
                   'description'   => 'required',
               ]);
           }




       public function authentication(){

           $permission = false;

           if(Auth::check()){

               $id = Auth::user()->id;

               $user = User::find($id);

               if(isset($user->groupRel)){

                   foreach ($user->groupRel as $item) {

                       $group = Group::all()->where('id', $item->pivot->group_id)->first();

                       if ($group->name == 'admin') {

                           $permission = true;

                       }
                   }

               }
           }

           return $permission;

       }

       }



