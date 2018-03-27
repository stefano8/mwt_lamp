<?php
/**
 * Created by PhpStorm.
 * User: stefanocorsetti
 * Date: 02/03/18
 * Time: 15:04
 */

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use App\Group;
use App\Image;
use App\Itinerary;
use App\User;
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

        $var = $this->authentication();

        if($var){

            return view('admin/itinerary/index', ['itinerary' => $itinerary]);

        }else{

            return view ('auth.login');
        }


    }


    public function create()
    {

        $var = $this->authentication();

        if($var){

            return view('admin/itinerary/create');

        }else{

            return view ('auth.login');
        }


    }


    public function save(Request $request)
    {

        $permission = $this->authentication();

        if($permission){
            $this->validateItems($request);

            DB::table('itineraries')
                ->insert([
                    'name' => $request['name'],
                    'difficolty' => $request['difficolty'],
                    'difference' => $request['difference'],
                    'description' => $request['description'],
                    'duration' => $request['duration'],
                    'created_at' => now()
                ]);

            flash('Success')->success();

            return redirect('admin/itinerary/index');

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

        $var = $this->authentication();

        if($var){
            $itinerary = Itinerary::find($id);

            //delete categorie_itinerari
            $itinerary->categoryRel()->wherePivot('itinerary_id', '=', $id)
                ->detach();

            //delete event relazionati a itinerari
            $itinerary->eventRel()->where('itinerary_id', '=', $id)->delete();

            //news

            DB::table('images')
                ->where('itinerary_id', '=', $id)
                ->delete();

            DB::table('news')
                ->where('itinerary_id', $id)
                ->delete();

            //image
            $itinerary->itineraryImage()->where('itinerary_id', '=', $id)->delete();

            //rewiew
            DB::table('reviews')
                ->where('itinerary_id', $id)
                ->delete();
            //$itinerary->itineraryRewiew()->where('itinerary_id','=',$id)->delete();


            //voti
            $itinerary->itineraryVote()->where('itinerary_id', '=', $id)->delete();

            //visti
            $itinerary->itineraryView()->wherePivot('itinerary_id', '=', $id)->detach();

            //wishlist
            $itinerary->toPossess()->wherePivot('itinerary_id', '=', $id)->detach();


            DB::table('itineraries')
                ->where('id', $id)
                ->delete();

            flash('Deleted')->error();

            return redirect()->back();

        }else{

            return view ('auth.login');
        }



    }


    public function edit($id)
    {
        $itinerary = DB::table('itineraries')
            ->where('id', $id)
            ->first();

        $var = $this->authentication();

        if($var){

            return view('admin/itinerary/edit', ['itinerary' => $itinerary]);

        }else{

            return view ('auth.login');
        }




    }


    public function store($id, Request $request)
    {

        $var = $this->authentication();


        if($var){

            $this->validateItems($request);

            DB::table('itineraries')
                ->where('id', $id)
                ->update([
                    'name' => $request['name'],
                    'difficolty' => $request['difficolty'],
                    'difference' => $request['difference'],
                    'description' => $request['description'],
                    'duration' => $request['duration'],
                    'updated_at' => now()
                ]);

            flash('Success')->success();

            return redirect('admin/itinerary/index');

        }else{

            return view ('auth.login');
        }



    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'difficolty' => 'required',
            'difference' => 'required',
            'description' => 'required',
            'duration' => 'required',
        ]);
    }


    //assegnamento di categorie a itinerari


    public function showAssignment($id)
    {

        /*$user = DB::table('users')
            ->where('id', $id)
            ->first();*/

        $category = DB::table('categories')
            ->get();


        $itinerary = Itinerary::find($id);

        $var = $this->authentication();


        if($var){

            return view('admin/itinerary/assign', ['itinerary' => $itinerary], ['category' => $category]);


        }else{

            return view ('auth.login');
        }




    }


    public function saveAssignment(Request $request)
    {

        $autentica = $this->authentication();


        if($autentica){

            $ngroup = Category::all()->count();


            $itinerary = Itinerary::find($request['itinerary_id']);

            $var = 0;
            $var1 = $request['category_id'];
            foreach ($itinerary->categoryRel as $role) {

                if ($role->pivot->category_id != $var1) {

                    $var = $var + 1;
                }else {

                     $var = $var - 1;
                }

            }


            if ($var < $ngroup && $var !== 0 && $var >= 1) {

                DB::table('itineraries_categories')
                    ->insert([
                        'itinerary_id' => $request['itinerary_id'],
                        'category_id' => $request['category_id'],
                ]);

            }

        //se label assegned non c'è allora inserisce
            if (!isset($_GET['category'])) {
                DB::table('itineraries_categories')
                    ->insert([
                        'itinerary_id' => $request['itinerary_id'],
                        'category_id' => $request['category_id'],
                    ]);

            }


            return redirect('admin/itinerary/index');


        }else{

            return view ('auth.login');
        }




    }


    //rimuove il gruppo selezionato
    public function removeAssignment($itineraryId, $categoryId)
    {
        $autentica = $this->authentication();

        if($autentica) {

            $itinerary = Itinerary::find($itineraryId);

            $itinerary->categoryRel()->wherePivot('itinerary_id', '=', $itineraryId)
                ->wherePivot('category_id', '=', $categoryId)
                ->detach();

            return redirect()->back();

        }else{

            return view ('auth.login');
        }

    }


    //frontend

    public function getItineraries($id)
    {

        $itinerary = Itinerary::paginate(10);

        $category = Category::all();

        $id = Auth::user()->id;

        $user = User::find($id);

        $permission = false;

        if (Auth::check()) {

            $id = Auth::user()->id;

            $user = User::find($id);



            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }
            return \Illuminate\Support\Facades\View::make('itineraries')
                ->with('itineraries', $itinerary)
                ->with('user', $user)
                ->with('category', $category)
                ->with('permission', $permission);

        }


        return View::make('itineraries')
            ->with('itineraries', $itinerary)
            ->with('category', $category)
            ->with('user', $user);
    }


    //funzione per mostare la media del voto su ogni itinerario
    public function singleItinerary($id)
    {
        $itinerary = DB::table('itineraries')
            ->where('id', $id)->first();

        $category = DB::table('categories')->get();

        $review = DB::table('reviews')
            ->where('approved', 1)
            ->where('itinerary_id', '=', $id)
            ->get();

        $image = DB::table('images')
            ->where('itinerary_id', '=', $id)->get();

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $voteUser = Vote::all()
            ->where('itinerary_id', $id)
            ->where('user_id', $user_id)
            ->first();

        $mediaVote = Vote::all()
            ->where('itinerary_id', $id);

        $voteNumber = Vote::all()
            ->where('itinerary_id', $id)
            ->count();

        $somma = 0;

        foreach ($mediaVote as $vote) {
            $somma += $vote->vote;
        }


        if ($voteNumber !== 0) {

            $media = ((int)($somma / $voteNumber));
        } else {
            $media = 0;
        }

        $bottoneWishlist = Wishlist::all()
            ->where('user_id', $user_id)
            ->where('itinerary_id', $id)
            ->first();

        $bottoneCollection = \App\View::all()
            ->where('user_id', $user_id)
            ->where('itinerary_id', $id)
            ->first();

        $permission = false;

        if (Auth::check()) {

            $id = Auth::user()->id;

            $user = User::find($id);



            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }

            return View::make('single')
                ->with('itinerary', $itinerary)
                ->with('review', $review)
                ->with('image', $image)
                ->with('user', $user)
                ->with('voteUser', $voteUser)
                ->with('media', $media)
                ->with('category', $category)
                ->with('bottoneCollection', $bottoneCollection)
                ->with('bottoneWishlist', $bottoneWishlist)
                ->with('user', $user)
                ->with('permission', $permission);
        }else {

            return View::make('single')
                ->with('itinerary', $itinerary)
                ->with('review', $review)
                ->with('image', $image)
                ->with('user', $user)
                ->with('voteUser', $voteUser)
                ->with('media', $media)
                ->with('category', $category)
                ->with('bottoneCollection', $bottoneCollection)
                ->with('bottoneWishlist', $bottoneWishlist);

        }

    }


    //funzione per dare un nuovo voto oppure modificare il voto precedente
    public function addvote($itineraryId, $userId, $value)
    {

        $voteSingle = Vote::all()
            ->where('itinerary_id', $itineraryId)
            ->where('user_id', $userId)
            ->first();

        if ($voteSingle != null) {
            DB::table('votes')
                ->where('itinerary_id', $itineraryId)
                ->where('user_id', $userId)
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
    public function addToWishlist($id)
    {

        $user = Auth::user()->id;

        $itineraryWish = Wishlist::all()
            ->where('itinerary_id', $id)
            ->where('user_id', $user)
            ->first();

        if ($itineraryWish != null) {

            //non faccio niente poichè già è presente

        } else {
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
    public function removeToWishlist($itineraryId)
    {

        $itinerary = Itinerary::find($itineraryId);

        $user = Auth::user()->id;

        $itinerary->toPossess()
            ->wherePivot('itinerary_id', '=', $itineraryId)
            ->wherePivot('user_id', '=', $user)
            ->detach();

        return redirect()->back();

    }

    //funzione per aggiungere un itinerario alla collezione personale
    public function addToCollection($id)
    {

        $user = Auth::user()->id;

        $itineraryView = \App\View::all()
            ->where('itinerary_id', $id)
            ->where('user_id', $user)
            ->first();

        if ($itineraryView != null) {

            //non faccio niente poichè già è presente (già visto)

        } else {
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
    public function removeToCollection($itineraryId)
    {

        $itinerary = Itinerary::find($itineraryId);

        $user = Auth::user()->id;

        $itinerary->itineraryView()
            ->wherePivot('itinerary_id', '=', $itineraryId)
            ->wherePivot('user_id', '=', $user)
            ->detach();

        return redirect()->back();

    }

    //lista collection sul profilo
    public function showProfile()
    {


        $id = Auth::user()->id;

        $user = User::find($id);

        $userName = DB::table('users')->where('id', $id)->first();

        //views
        $collection = DB::table('views')->where('user_id', $id)->get();

        $arrayImageC = [];
        $arrayItinerary = [];
        $i = 0;

        foreach ($collection as $collections) {

            $image = DB::table('images')->where('itinerary_id', $collections->itinerary_id)->first();
            //array per nome itineraio oppure con la relaizone di imagine verso itinerario ci riprendtiamo il nome
            $itinerario = DB::table('itineraries')->where('id', $image->itinerary_id)->first();

            $arrayItinerary[$i] = $itinerario->name;
            $arrayImageC[$i] = $image->path;
            $i++;

        }

        //wishlist

        $wishlist = DB::table('wishlists')->where('user_id', $id)->get();

        //echo ((string)($collection));
        $arrayImageW = [];
        $arrayItineraryW = [];
        $a = 0;

        foreach ($wishlist as $wishlists) {

            $image = DB::table('images')->where('itinerary_id', $wishlists->itinerary_id)->first();
            //array per nome itineraio oppure con la relaizone di imagine verso itinerario ci riprendtiamo il nome
            $itinerario = DB::table('itineraries')->where('id', $image->itinerary_id)->first();

            $arrayItineraryW[$a] = $itinerario->name;
            $arrayImageW[$a] = $image->path;
            $a++;

        }

        if (Auth::check()) {

            $permission = false;

            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }
            return \Illuminate\Support\Facades\View::make('profile')
                ->with('arrayItinerary', $arrayItinerary)
                ->with('user', $user)
                ->with('userName', $userName)
                ->with('arrayImageC', $arrayImageC)
                ->with('arrayImageW', $arrayImageW)
                ->with('arrayItineraryW', $arrayItineraryW)
                ->with('user', $user)
                ->with('permission', $permission);

        }


        return View::make('profile')
            ->with('arrayItinerary', $arrayItinerary)
            ->with('user', $user)
            ->with('userName', $userName)
            ->with('arrayImageC', $arrayImageC)
            ->with('arrayImageW', $arrayImageW)
            ->with('arrayItineraryW', $arrayItineraryW);

    }


    public function showSingleItinerary($nameItinerary)
    {


        $itinerario = DB::table('itineraries')->where('name', $nameItinerary)->first();
        $id = $itinerario->id;

        return $this->singleItinerary($id);

    }

    //funzione per la ricerca di itinerari della schermata principale (per nome)
    public function search(Request $request)
    {
        $search = $request->itinerary_name;

        $itinerary = Itinerary::where('name', 'like', "%$search%")
            ->paginate(10);

        $permission = false;

        if (Auth::check()) {

        $id = Auth::user()->id;

        $user = User::find($id);

            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }

            //return view('search', compact('itinerary'), ['user' => $user], ['permission' => $permission]);

            return \Illuminate\Support\Facades\View::make('search')
                ->with('itinerary', $itinerary)
                ->with('user', $user)
                ->with('permission', $permission);
        }

        //else
        return view('search', compact('itinerary'));


    }

    //funzione per filtrare itinerari per categorie
    public function filterCategory($id)
    {

        $itinerary = Itinerary::whereHas('categoryRel', function ($query) use ($id) {
            $query->where('category_id', '=', $id);
        })->paginate(10);


        $category = Category::all();

        $permission = false;

        if (Auth::check()) {

        $id = Auth::user()->id;

        $user = User::find($id);

            foreach ($user->groupRel as $item) {

                $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;
                }
            }

            return \Illuminate\Support\Facades\View::make('itineraries')
                ->with('itineraries', $itinerary)
                ->with('category', $category)
                ->with('user', $user)
                ->with('permission', $permission);

        }

        return View::make('itineraries')
            ->with('itineraries', $itinerary)
            ->with('category', $category);

    }



    public function authentication(){

        $permission = false;

        if(Auth::check()){

            $id = Auth::user()->id;

            $user = User::find($id);

            if(isset($user->groupRel)){

                foreach ($user->groupRel as $item)

                    $group = Group::all()->where('id', $item->pivot->group_id)->first();

                if ($group->name == 'admin') {

                    $permission = true;

                }

            }
        }

        return $permission;

    }


}


