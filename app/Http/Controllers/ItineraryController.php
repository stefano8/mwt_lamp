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
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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

        flash('Success')->success();

        return redirect('admin/itinerary/index');

    }


    public function delete($id)
    {
        $itinerary = Itinerary::find($id);

        //delete categorie_itinerari
        $itinerary->categoryRel()->wherePivot('itinerary_id','=',$id)
                    ->detach();

        //delete event relazionati a itinerari
        $itinerary->eventRel()->where('itinerary_id','=',$id)->delete();

        //news

        DB::table('images')
            ->where('itinerary_id','=', $id)
            ->delete();

        DB::table('news')
            ->where('itinerary_id', $id)
            ->delete();

        //image
        $itinerary->itineraryImage()->where('itinerary_id','=',$id)->delete();

        //rewiew
        DB::table('reviews')
            ->where('itinerary_id', $id)
            ->delete();
        //$itinerary->itineraryRewiew()->where('itinerary_id','=',$id)->delete();


        //voti
        $itinerary->itineraryVote()->where('itinerary_id','=',$id)->delete();

        //visti
        $itinerary->itineraryView()->wherePivot('itinerary_id','=',$id)->detach();

        //wishlist
        $itinerary->toPossess()->wherePivot('itinerary_id','=',$id)->detach();


        DB::table('itineraries')
            ->where('id', $id)
            ->delete();

        flash('Deleted')->error();

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

        flash('Success')->success();


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
                    'category_id'           => $request['category_id'],
                ]);

        }

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
            //->where('itinerary_id', '=', $id)
            ->first();

        /*$itinerayImage = DB::table('images')
            ->first();

        //$itinerayImage->imageItinerary()->wherePivot('itinerary_id','=',$id)->first();
*/
        $category = Category::all();

        return View::make('itineraries')
            ->with('itineraries', $itinerary)
            ->with('image', $image)
            //->with('itineraryImage', $itinerayImage)
            ->with('category', $category);
    }


    //funzione per mostare la media del voto su ogni itinerario
    public function singleItinerary($id)
    {
        $itinerary = DB::table('itineraries')
            ->where('id', $id)->first();

        $category = DB::table('categories')->get();

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


        if($voteNumber !== 0){

            $media = ((int)($somma/$voteNumber));
        }else{
            $media = 0;
        }

        return View::make('single')
            ->with('itinerary', $itinerary)
            ->with('review', $review)
            ->with('image', $image)
            ->with('user', $user)
            ->with('voteUser', $voteUser)
            ->with('media', $media)
            ->with('category', $category);



    }


    //funzione per dare un nuovo voto oppure modificare il voto precedente
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


    //funzione per aggiungere un itinerario alla wishlist personale
    public function addToWishlist($id){

        $user = Auth::user()->id;

        $itineraryWish = Wishlist::all()
            ->where('itinerary_id', $id)
            ->where('user_id', $user)
            ->first();

        if($itineraryWish != null){

            //non faccio niente poichè già è presente

        }else{
            DB::table('wishlists')
                ->insert([
                    'itinerary_id' => $id,
                    'user_id' => $user,
                    'created_at' => now(),
                ]);
        }

        return redirect()->back();

    }

    //funzione per rimuovere un itinerario dalla wishlist personale
    public function removeToWishlist($itineraryId){

        $itinerary = Itinerary::find($itineraryId);

        $user = Auth::user()->id;

        $itinerary->toPossess()
            ->wherePivot('itinerary_id','=',$itineraryId)
            ->wherePivot('user_id' , '=', $user)
            ->detach();

        return redirect()->back();

    }

    //funzione per aggiungere un itinerario alla collezione personale
    public function addToCollection($id){

        $user = Auth::user()->id;

        $itineraryView = \App\View::all()
            ->where('itinerary_id', $id)
            ->where('user_id', $user)
            ->first();

        if($itineraryView != null){

            //non faccio niente poichè già è presente (già visto)

        }else{
            DB::table('views')
                ->insert([
                    'itinerary_id' => $id,
                    'user_id' => $user,
                    'created_at' => now(),
                ]);
        }

        return redirect()->back();

    }

    //funzione per rimuovere un itinerario dalla collezione personale
    public function removeToCollection($itineraryId){

        $itinerary = Itinerary::find($itineraryId);

        $user = Auth::user()->id;

        $itinerary->itineraryView()
            ->wherePivot('itinerary_id','=',$itineraryId)
            ->wherePivot('user_id' , '=', $user)
            ->detach();

        return redirect()->back();

    }

    //funzione per la ricerca di itinerari della schermata principale (per nome)
    public function search(Request $request)
    {
       $search = $request->itinerary_name;

       $itinerary = DB::table('itineraries')
           ->where('name', 'like', "%$search%")
           ->paginate(10);

       return view('search', compact('itinerary'));

       //echo $search, $itinerary;

    }

    //funzione per filtrare itinerari per categorie
    public function filterCategory($id){
        //
    }


}


