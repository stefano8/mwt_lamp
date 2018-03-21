<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    //backend

    public function index()
    {
        $news = News::paginate(10);

        return view('admin/news/index', ['news' => $news]);
    }


    public function create()

    {
        $itinerary = DB::table('itineraries')->get();

        return view('admin/news/create', ['itinerary' => $itinerary]);
    }


    public function save(Request $request)
    {
        $this->validateItems($request);

        DB::table('news')
            ->insert([
                'date'              => now(),
                'title'             => $request['title'],
                'body'              => $request['body'],
                'itinerary_id'      => $request['itinerary_id'],  //il valore della selectbox
                'created_at'        => now()
            ]);

        flash('Success')->success();

        return redirect('admin/news/index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        DB::table('images')
            ->where('new_id','=', $id)
            ->delete();


        DB::table('news')
            ->where('id', $id)
            ->delete();

        flash('Deleted')->error();

        return redirect()->back();
    }

    public function edit($id)
    {
        $news = DB::table('news')
            ->select('*')
            ->where('id', $id)
            ->first();

        $itinerary = DB::table('itineraries')
            ->get();



        return view('admin/news/edit', ['news' => $news], ['itinerary' => $itinerary]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('news')
            ->where('id', $id)
            ->update([
                'title'             => $request['title'],
                'body'              => $request['body'],
                'itinerary_id'      => $request['itinerary_id'],
                'updated_at'        => now(),
            ]);

        flash('Success')->success();


        return redirect('admin/news/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'body'          => 'required',
            'itinerary_id'  => 'required',
        ]);
    }


    public function getNews(){

        $news = DB::table('news')->get();

        return view('news', ['news'=>$news]);
    }

}
