<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Event;
use Auth;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('private', 0)->whereDate('data', '>', date('Y-m-d'))->get();

        return view('app.events')->with('create', 0)->with('active', 'events')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.events')->with('create', 1)->with('active', 'events');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:90',
            'description' => 'required|max:255',
            'data' => 'required|date',
            'place' => 'max:30',
            'picture' => 'image'
        ]);

        if ($request->input('private')){
            $private = 1;
        } else {
            $private = 0;
        }

        if ($request->hasFile('picture')){
            $image = $request->file('picture');

            if ($image->isValid()){
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move('img/events/', $filename);
            }            
        } else {
            $filename = 'default.png';
        }

        $event = Auth::user()->events()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'data' => $request->input('data'),
            'place' => $request->input('place'),
            'private' => $private,
            'picture' => $filename,
        ]);

        return $this->show($event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('app.events.index')->with('event', $event)->with('active', 'events');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
