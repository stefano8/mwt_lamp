<?php
/**
 * Created by PhpStorm.
 * User: stefanocorsetti
 * Date: 02/03/18
 * Time: 15:04
 */

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Itinerary;
use App\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\Cast\Int_;

class ItineraryController extends Controller
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
        //$itinerary = DB::table('itineraries')->get();
        $itinerary = Itinerary::paginate(10);

        return view('admin/itinerary/index', ['itinerary' => $itinerary]);
    }


    public function create()
    {

        return view('admin/itinerary/create');
    }


    public function save(Request $request)
    {

        $this->validateItems($request);

        DB::table('itineraries')
            ->insert([
                'name'          => $request['name'],
                'difficolty'    => $request['difficolty'],
                'difference'    => $request['difference'],
                'description'   => $request['description'],
                'duration'      => $request['duration'],
                'created_at'    => now()
            ]);

        return redirect('admin/itinerary/index');

    }


    public function delete($id)
    {

        DB::table('itineraries')
            ->where('id', $id)
            ->delete();

        return redirect()->back();


    }


    public function edit($id)
    {
        $itinerary = DB::table('itineraries')
            ->where('id', $id)
            ->first();

        return view('admin/itinerary/edit', ['itinerary' => $itinerary]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('itineraries')
            ->where('id', $id)
            ->update([
                'name'          => $request['name'],
                'difficolty'    => $request['difficolty'],
                'difference'    => $request['difference'],
                'description'   => $request['description'],
                'duration'      => $request['duration'],
                'updated_at'    => now()
            ]);


        return redirect('admin/itinerary/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'difficolty'    => 'required',
            'difference'    => 'required',
            'description'   => 'required',
            'duration'      => 'required',
        ]);
    }


    //assegnamento di categorie a itinerari


    public function showAssignment($id){

        /*$user = DB::table('users')
            ->where('id', $id)
            ->first();*/

        $category = DB::table('categories')
            ->get();


        $itinerary = Itinerary::find($id);


        return view('admin/itinerary/assign', ['itinerary' => $itinerary], ['category' => $category]);

    }



    public function saveAssignment(Request $request){

        $ngroup = Category::all()->count();


        $itinerary = Itinerary::find($request['itinerary_id']);

        $var= 0;
        $var1 = $request['category_id'];
        foreach ($itinerary->categoryRel as $role)
        {

            if($role->pivot->category_id != $var1 ){

                $var = $var +1;
            }else{

                $var = $var - 1;
            }

        }


        if($var < $ngroup && $var !== 0 && $var >= 1){

            DB::table('itineraries_categories')
                ->insert([
                    'itinerary_id'          => $request['itinerary_id'],
                    'category_id'         => $request['category_id'],
                ]);

        }

        //se label assegned non c'è allora inserisce
        if(!isset( $_GET['category'])){
            DB::table('itineraries_categories')
                ->insert([
                    'itinerary_id'          => $request['itinerary_id'],
                    'category_id'         => $request['category_id'],
                ]);

        }

        /*$user = User::find($request['user_id']);


        foreach ($user->groupRel as $role)
        {
            $role->pivot->group_id = $request['group_id'];
            $role->pivot->save();
        }


*/
        return redirect('admin/itinerary/index');

    }



    //rimuove il gruppo selezionato
    public function removeAssignment($itineraryId,$categoryId)
    {

        $itinerary = Itinerary::find($itineraryId);

        $itinerary->categoryRel()->wherePivot('itinerary_id','=',$itineraryId)
                                ->wherePivot('category_id' , '=', $categoryId)
                                ->detach();

        return redirect()->back();
    }



    //frontend

    public function getItineraries($id)
    {

        $itinerary = Itinerary::paginate(10);


        $image = DB::table('images')
            //->where('itinerary_id', '=', 1)
            ->first();

        return view('itineraries', ['itineraries' => $itinerary], ['image' => $image]);

    }


    public function singleItinerary($id)
    {
        $itinerary = DB::table('itineraries')
            ->where('id', $id)->first();

        $review = DB::table('reviews')
            ->where('approved', 1)
            ->where('itinerary_id','=', $id)
            ->get();

        $image = DB::table('images')
            ->where('itinerary_id', '=' , $id)->get();

        $user = Auth::user()->id;

        $voteUser = Vote::all()
            ->where('itinerary_id', $id)
            ->where('user_id', $user)
            ->first();

        $mediaVote = Vote::all()
            ->where('itinerary_id', $id);

        $voteNumber = Vote::all()
            ->where('itinerary_id', $id)
            ->count();

        $somma = 0;

        foreach ($mediaVote as $vote){
            $somma += $vote->vote;
        }

        $media = ((int)($somma/$voteNumber));

        return View::make('single')
            ->with('itinerary', $itinerary)
            ->with('review', $review)
            ->with('image', $image)
            ->with('user', $user)
            ->with('voteUser', $voteUser)
            ->with('media', $media);



    }



    public function addvote($itineraryId, $userId, $value){

        $voteSingle = Vote::all()
            ->where('itinerary_id', $itineraryId)
            ->where('user_id', $userId)
            ->first();

        if ($voteSingle != null){
            DB::table('votes')
                ->where('itinerary_id',$itineraryId)
                ->where('user_id',$userId)
                ->update([
                    'vote' => $value,
                    'updated_at' => now(),
                ]);

        } else {
            DB::table('votes')
                ->insert([
                    'vote' => $value,
                    'itinerary_id' => $itineraryId,
                    'user_id' => $userId,
                    'created_at' => now(),

                ]);
        }

        return redirect()->back();
    }




}


