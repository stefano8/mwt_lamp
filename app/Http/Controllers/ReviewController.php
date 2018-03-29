<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Itinerary;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{


    //backend

    public function index()
    {

        $permission = $this->authentication();

        if($permission){

            $review = Review::paginate(10);

            return view('admin/review/index', ['review' => $review]);

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }



    }

    public function approve($id){

        $permission = $this->authentication();

        if($permission){

            DB::table('reviews')
                ->where('id', $id)
                ->update([
                    'approved' => 1,
                ]);

            flash('Approved')->success();

            return redirect('admin/review/index');

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }

    }

    public function delete($id){

        $permission = $this->authentication();

        if($permission){

            DB::table('reviews')
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




    //frontend

    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'title'          => 'required',
            'body'           => 'required',
        ]);
    }



    public function insert(Request $request, $itinerary_id){


        if (Auth::check()) {

            $this->validateItems($request);
            $id = Auth::user()->id;                            //   MI RIPRENDO L'ID DELL'UTENTE CHE SCRIVE LA RECNESIONE (IN SESSIONE)

            DB::table('reviews')
                ->insert([
                    'date'          => now(),                   //FUNZIONE CHE RIPRENDE LA DATA CORRENTE
                    'title'         => $request['title'],
                    'body'          => $request['body'],
                    'approved'      => 0,                       //SETTATA A 0 PER NON FARLA VEDERE -> DEVE ESSERE ACCETTATA DA AMMINISTARTORE
                    'user_id'       => $id,
                    'itinerary_id'  => $itinerary_id,
                ]);


            return redirect()->back();

        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
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
