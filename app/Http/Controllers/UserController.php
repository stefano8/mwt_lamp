<?php

namespace App\Http\Controllers;

use App\Group;
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
       /* $user = DB::table('users')
            ->leftJoin('users_groups', 'users.id', '=', 'users_groups.group_id')
            ->select('users.id' ,'users.name', 'users.email', 'users_groups.group_id')
            ->get();*/
       $user = DB::table('users')->get();


        /* $user_group = DB::table('users_groups')
             ->where('users_groups.user_id', '=', 1)
             ->select('users_groups.group_id')
             ->first();
         */

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
        $user = User::find($id);


            $user->groupRel()->wherePivot('user_id','=',$id)->detach();

            DB::table('users')
                ->where('id', $id)
                ->delete();


        return redirect()->back();
    }


    //funzione per assegnare gruppi
    public function showAssignment($id){

        /*$user = DB::table('users')
            ->where('id', $id)
            ->first();*/

        $group = DB::table('groups')
            ->get();



        $user = User::find($id);

        //conto quanti users_group per user = $id ci sono
        $countUsersGroups = User::find($id)->groupRel()->wherePivot('user_id', '=', $id)->count();

        //conto i gruppi
        $countGroup = Group::all()->count();




        return view('admin/user/assign', ['user' => $user], ['group' => $group]);

    }

    public function saveAssignment(Request $request){

       /* DB::table('users_groups')
            ->insert([
                'user_id'          => $request['user_id'],
                'group_id'         => $request['group_id'],
            ]);*/


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





        /*$user = User::find($request['user_id']);


        foreach ($user->groupRel as $role)
        {
            $role->pivot->group_id = $request['group_id'];
            $role->pivot->save();
        }


*/
        return redirect('admin/user/index');

    }


    //funzione per profilo
    public function settings(){

        $user = DB::table('users')
            ->first();

        return view('admin/settings', ['user' => $user]);
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
        ]);
    }

    /*public function showDash(){

        $user_group = DB::table('users_groups')
            ->where('users_groups.user_id', '=', Auth::user()->id)
            ->first();

        return view('welcome', ['user_group' => $user_group]);
    }*/


    //rimuove il gruppo selezionato
    public function removeAssignment($userId,$groupId)
    {

        $user = User::find($userId);

        $user->groupRel()->wherePivot('user_id','=',$userId)
                        ->wherePivot('group_id' , '=', $groupId)
                        ->detach();

        return redirect()->back();
    }
}
