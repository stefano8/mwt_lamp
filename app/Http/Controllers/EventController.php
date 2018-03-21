<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    //backend

    public function index()
    {
        $event = Event::paginate(10);

        return view('admin/event/index', ['event' => $event]);
    }


    public function create()
    {
        $itinerary = DB::table('itineraries')->get();

        return view('admin/event/create', ['itinerary' => $itinerary]);
    }


    public function save(Request $request)
    {
        $this->validateItems($request);

        DB::table('events')
            ->insert([
                'date'              => now(),
                'title'             => $request['title'],
                'body'              => $request['body'],
                'address'           => $request['address'],
                'description'       => $request['description'],
                'itinerary_id'      => $request['itinerary_id'],  //il valore della selectbox
                'created_at'        => now()
            ]);

        flash('Success')->success();

        return redirect('admin/event/index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('events')
            ->where('id', $id)
            ->delete();

        flash('Deleted')->error();

        return redirect()->back();
    }

    public function edit($id)
    {
        $event = DB::table('events')
            ->select('*')
            ->where('id', $id)
            ->first();

        $itinerary = DB::table('itineraries')
            ->get();



        return view('admin/event/edit', ['event' => $event], ['itinerary' => $itinerary]);
    }


    public function store($id, Request $request)
    {
        $this->validateItems($request);

        DB::table('events')
            ->where('id', $id)
            ->update([
                'title'             => $request['title'],
                'body'              => $request['body'],
                'address'           => $request['address'],
                'description'       => $request['description'],
                'itinerary_id'      => $request['itinerary_id'],
                'updated_at'        => now(),
            ]);

        flash('Success')->success();

        return redirect('admin/event/index');
    }


    public function validateItems(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'body'          => 'required',
            'address'       => 'required',
            'description'   => 'required',
            'itinerary_id'  => 'required',
        ]);
    }
}
