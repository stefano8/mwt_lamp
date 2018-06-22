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
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
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


    //backend

    public function index()
    {
        $itinerary = Itinerary::paginate(10);

        $permission = $this->authentication();

        if($permission){

            return view('admin/itinerary/index', ['itinerary' => $itinerary]);

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

            return view('admin/itinerary/create');

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

            DB::table('itineraries')
                ->insert([
                    'name' => $request['name'],
                    'difficolty' => $request['difficolty'],
                    'difference' => $request['difference'],
                    'description' => $request['description'],
                    'duration' => $request['duration'],
                    'latitude' => $request['latitude'],
                    'longitude' => $request['longitude'],
                    'created_at' => now(),
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

        $permission = $this->authentication();

        if($permission){
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

            $itinerary = DB::table('itineraries')
                ->where('id', $id)
                ->first();

            return view('admin/itinerary/edit', ['itinerary' => $itinerary]);

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

            DB::table('itineraries')
                ->where('id', $id)
                ->update([
                    'name' => $request['name'],
                    'difficolty' => $request['difficolty'],
                    'difference' => $request['difference'],
                    'description' => $request['description'],
                    'duration' => $request['duration'],
                    'latitude' => $request['latitude'],
                    'longitude' => $request['longitude'],
                    'updated_at' => now()
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


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'difficolty'    => 'required',
            'difference'    => 'required',
            'description'   => 'required',
            'duration'      => 'required',
            'latitude'      => 'required',
            'longitude'     => 'required',
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

        $permission = $this->authentication();


        if($permission){

            return view('admin/itinerary/assign', ['itinerary' => $itinerary], ['category' => $category]);


        }else{

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }




    }


    public function saveAssignment(Request $request)
    {

        $permission = $this->authentication();


        if($permission){

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

            $itineraries = Itinerary::take(4)->get();
            $events = Event::take(3)->get();
            return \Illuminate\Support\Facades\View::make('welcome')
                ->with('permission', $permission )
                ->with('itineraries', $itineraries)
                ->with('events', $events);
        }




    }


    //rimuove il gruppo selezionato
    public function removeAssignment($itineraryId, $categoryId)
    {
        $permission = $this->authentication();

        if($permission) {

            $itinerary = Itinerary::find($itineraryId);

            $itinerary->categoryRel()->wherePivot('itinerary_id', '=', $itineraryId)
                ->wherePivot('category_id', '=', $categoryId)
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


    //frontend

    public function getItineraries()
    {

        $itinerary = Itinerary::paginate(10);

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
                ->with('user', $user)
                ->with('category', $category)
                ->with('permission', $permission);

        }


        return View::make('itineraries')
            ->with('itineraries', $itinerary)
            ->with('category', $category);

    }


    //funzione per mostare la media del voto su ogni itinerario
    public function singleItinerary($id)
    {

        /*Mapper::map(42.5032400, 13.6572100)
            ->circle([['latitude' => 42.5032400, 'longitude' => 13.6572100]],
                ['strokeColor' => 'red', 'strokeOpacity' => 2, 'strokeWeight' => 200, 'fillColor' => 'red', 'radius' => 1000]
            );*/


        $itinerary = DB::table('itineraries')
            ->where('id', $id)->first();

        Mapper::map($itinerary->latitude, $itinerary->longitude)
            ->circle([['latitude' => $itinerary->latitude, 'longitude' => $itinerary->longitude]],
                ['strokeColor' => 'red', 'strokeOpacity' => 2, 'strokeWeight' => 200, 'fillColor' => 'red', 'radius' => 1000]
            );

        $category = DB::table('categories')->get();

        $review = DB::table('reviews')
            ->where('approved', 1)
            ->where('itinerary_id', '=', $id)
            ->get();

        $image = DB::table('images')
            ->where('itinerary_id', '=', $id)->get();


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





        $permission = false;

        if (Auth::check()) {
            $var = 1;

            $user_id = Auth::user()->id;

            $user = User::find($user_id);

            $voteUser = Vote::all()
                ->where('itinerary_id', $id)
                ->where('user_id', $user_id)
                ->first();

            $bottoneWishlist = Wishlist::all()
                ->where('user_id', $user_id)
                ->where('itinerary_id', $id)
                ->first();

            $bottoneCollection = \App\View::all()
                ->where('user_id', $user_id)
                ->where('itinerary_id', $id)
                ->first();



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
                ->with('var', $var)
                ->with('permission', $permission);

        }else {

            $var = 0;
            return View::make('single')
                ->with('itinerary', $itinerary)
                ->with('review', $review)
                ->with('image', $image)
                //->with('user', $user)
                //->with('voteUser', $voteUser)
                ->with('media', $media)
                ->with('var', $var)
                ->with('category', $category);
                //->with('bottoneCollection', $bottoneCollection)
            // ->with('bottoneWishlist', $bottoneWishlist);

            //vanno tolti perchè sono cose che servono solo in caso sei loggato, e in più vanno fatti i controlli con isset nel
            //nel blade altrimenti da errore

        }

    }


    //funzione per dare un nuovo voto oppure modificare il voto precedente
    public function addvote($itineraryId, $userId, $value)
    {
        if (Auth::check()) {

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

        }else{

            /*$voteUser = Vote::all()
                ->where('itinerary_id', $itineraryId)
                ->where('user_id', $userId)
                ->first();*/

            $itinerary = Itinerary::find($itineraryId);
            $review = DB::table('reviews')
                ->where('approved', 1)
                ->where('itinerary_id', '=', $itineraryId)
                ->get();

            $image = DB::table('images')
                ->where('itinerary_id', '=', $itineraryId)->get();


            $mediaVote = Vote::all()
                ->where('itinerary_id', $itineraryId);

            $voteNumber = Vote::all()
                ->where('itinerary_id', $itineraryId)
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
            $category = DB::table('categories')->get();
            $var = 0;

            return View::make('single')
                ->with('itinerary', $itinerary)
                ->with('review', $review)
                ->with('image', $image)
                //->with('user', $user)
                ->with('var', $var)
                ->with('media', $media)
                ->with('category', $category);
            //->with('bottoneCollection', $bottoneCollection)
            // ->with('bottoneWishlist', $bottoneWishlist);
        }
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

        $dCollection = array_combine($arrayItinerary, $arrayImageC);

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


        $dWishlist = array_combine($arrayItineraryW, $arrayImageW);

       // print_r($arrayItinerary);
        //print_r($arrayImageW);
        //print_r($dWishlist);
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
                ->with('user', $user)
                ->with('permission', $permission)
                ->with('dCollection' ,$dCollection)
                ->with('dWishlist', $dWishlist);

        }


        return View::make('profile')
            ->with('arrayItinerary', $arrayItinerary)
            ->with('user', $user)
            ->with('userName', $userName)
            ->with('dCollection', $dCollection)
            ->with('dWishlist', $dWishlist);
           // ->with('arrayImageW', $arrayImageW)
            //->with('arrayItineraryW', $arrayItineraryW);


    }


    public function showSingleItinerary($nameItinerary)
    {

       /* $image = DB::table('images')->select('itinerary_id')->where('id', $nameItinerary)->where('title', '!=', 'bunner')->first();

        $itinerario = DB::table('itineraries')->where('id', $image->itinerary_id)->first();

        $id = $itinerario->id;

        return $this->singleItinerary($id);*/

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


