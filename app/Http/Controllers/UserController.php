<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $permission = $this->authentication();

        if($permission){

            /* $user = DB::table('users')
           ->leftJoin('users_groups', 'users.id', '=', 'users_groups.group_id')
           ->select('users.id' ,'users.name', 'users.email', 'users_groups.group_id')
           ->get();*/
            $user = User::paginate(10);


            /* $user_group = DB::table('users_groups')
                 ->where('users_groups.user_id', '=', 1)
                 ->select('users_groups.group_id')
                 ->first();
             */

            return view('admin/user/index', ['user' => $user]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $permission = $this->authentication();

        if($permission){

            $user = DB::table('users')
                ->where('id', $id)
                ->first();

            return view('admin/user/edit', ['user' => $user]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

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

        $permission = $this->authentication();

        if($permission){

            $this->validateItems($request);

            DB::table('users')
                ->where('id', $id)
                ->update([
                    'name'          => $request['name'],
                    'email'         => $request['email'],
                ]);

            flash('Success')->success();

            return redirect('admin/user/index');

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete($id)
    {

        $permission = $this->authentication();

        if($permission){

            $user = User::find($id);


            $user->groupRel()->wherePivot('user_id','=',$id)->detach();

            DB::table('users')
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


    //funzione per assegnare gruppi
    public function showAssignment($id){


        $permission = $this->authentication();

        if($permission){

            /*$user = DB::table('users')
            ->where('id', $id)
            ->first();*/

            $group = DB::table('groups')
                ->get();



            $user = User::find($id);


            //prendi tutti i gruppi per cui l'utente non ha relazione nella users_groups

            //conto quanti users_group per user = $id ci sono
            $countUsersGroups = User::find($id)->groupRel()->wherePivot('user_id', '=', $id)->count();
            $var = User::find($id)->groupRel()->wherePivot('user_id', '=', $id)->get();

            //per ogni $var prendi i gruppi assegnati poi
            // $gruppi = Group::find(1)->userRel()->wherePivot('user_id', '=', $id)->where('id', '!=', $var->group_id);

            //echo $gruppi;
            //echo $var;



            //conto i gruppi
            //$countGroup = Group::all()->count();


            return view('admin/user/assign', ['user' => $user], ['group' => $group]);
        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }

    public function saveAssignment(Request $request){

        $permission = $this->authentication();

        if($permission){

            $ngroup = Group::all()->count();


            $user = User::find($request['user_id']);

            $var= 0;
            $var1 = $request['group_id'];
            foreach ($user->groupRel as $role)
            {

                if($role->pivot->group_id != $var1 ){

                    $var = $var +1;
                }else{

                    $var = $var - 1;
                }

            }


            if($var < $ngroup && $var !== 0 && $var >= 1){

                DB::table('users_groups')
                    ->insert([
                        'user_id'          => $request['user_id'],
                        'group_id'         => $request['group_id'],
                    ]);

            }

            //se label assegned non c'è allora inserisce
            if(!isset( $_GET['group'])){
                DB::table('users_groups')
                    ->insert([
                        'user_id'          => $request['user_id'],
                        'group_id'         => $request['group_id'],
                    ]);

            }


            return redirect('admin/user/index');


        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }


    }


    //funzione per profilo
    public function settings(){

        $permission = $this->authentication();

        if($permission){

            $user = DB::table('users')
                ->first();

            return view('admin/settings', ['user' => $user]);


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
            'email'         => 'required',
        ]);
    }


    //rimuove il gruppo selezionato
    public function removeAssignment($userId,$groupId)
    {

        $permission = $this->authentication();

        if($permission){

            $user = User::find($userId);

            $user->groupRel()->wherePivot('user_id','=',$userId)
                ->wherePivot('group_id' , '=', $groupId)
                ->detach();

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
