<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    //backend

    public function index()
    {
        $review = Review::paginate(10);

        return view('admin/review/index', ['review' => $review]);
    }

    public function approve($id){

        DB::table('reviews')
            ->where('id', $id)
            ->update([
                'approved'          => 1,
            ]);

        return redirect('admin/review/index');

    }

    public function delete($id){

        DB::table('reviews')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
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
    }


}
