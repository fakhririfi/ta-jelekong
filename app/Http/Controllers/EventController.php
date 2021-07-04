<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return view('admin.events.index')->with([
            'events' => $events
        ]);
    }

    /**
     * Display a listing of the resource for customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_customer()
    {
        $current_events = Event::whereBetween('time', [Carbon::now()->startOfDay()->toDateTimeString(), Carbon::now()->addWeek(1)->startOfDay()->toDateTimeString()])->get();
        $future_events = Event::where('time', '>', Carbon::now()->addWeek(1)->startOfDay()->toDateTimeString())->get();
// dd(Carbon::now()->addWeek(1)->startOfDay()->toDateTimeString()); 
        return view('customer.events.index')->with([
            'current_events' => $current_events,
            'future_events' => $future_events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
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
            'name' => 'required',
            'time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quota' => 'required',
            'image' => 'required',
        ]);

        $path = $request->file('image')->store('events', 'public');

        $event = Event::create([
            'name' => $request->name,
            'time' => Carbon::parse($request->time),
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
            'quota' => $request->quota,
            'image' => $path
        ]);

        if ($event) {
            return redirect()->back()->with([
                'success' => 'Berhasil Menyimpan'
            ]);
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Gagal Menyimpan Data'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Display the specified resource for customer.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show_customer($id)
    {

        $event = Event::find($id);

        return view('customer.events.show')->with([
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if(!$event){
            return redirect()->back()->withErrors([
                'events' => 'data tidak ditemukan'
            ]);
        }

        return view('admin.events.edit')->with([
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        $this->validate($request, [
            'name' => 'required',
            'time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quota' => 'required',
        ]);

        $path = $event->image;
        if(isset($request->image)){
            $path = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'name' => $request->name,
            'time' => Carbon::parse($request->time),
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
            'quota' => $request->quota,
            'image' => $path
        ]);

        if ($event) {
            return redirect()->back()->with([
                'success' => 'Berhasil Menyimpan'
            ]);
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Gagal Menyimpan Data'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->back()->with([
            'success' => "Berhasil Menghapus $event->name"
        ]);
    }
}