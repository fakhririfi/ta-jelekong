<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // if ($request->ajax()) {
        //     $data = Schedule::all();

        //     return response()->json($data);
        // }

        return view('schedule');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $start =  $request->query('start');
        $end =  $request->query('end');
        return view('admin.schedule.create', with(['start' => $start, 'end' => $end]));
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
            'name'              => 'required',
            'time'              => 'required',
            'end'               => 'required',
            'location'          => 'required',
            'description'       => 'required',
            'contact_person'    => 'required',
            'organizer'         => 'required'
        ]);


        $event = Event::create([
            'name'              => $request->name,
            'time'              => Carbon::parse($request->time),
            'end'               => Carbon::parse($request->time),
            'location'          => $request->location,
            'description'       => $request->description,
            'contact_person'    => $request->contact_person,
            'organizer'         => $request->organizer,
            'user_id'           => $request->user()->id,
            'schedule'          => true,
        ]);

        if ($event) {
            return redirect()->route('schedule.index')->with([
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {

        if (!$event) {
            return redirect()->back()->withErrors([
                'events' => 'data tidak ditemukan'
            ]);
        }

        return view('admin.schedule.edit')->with([
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        $this->validate($request, [
            'name'              => 'required',
            'time'              => 'required',
            'end'               => 'required',
            'location'          => 'required',
            'description'       => 'required',
            'contact_person'    => 'required',
            'organizer'         => 'required'
        ]);


        $event->update([
            'name'              => $request->name,
            'time'              => Carbon::parse($request->time),
            'end'               => Carbon::parse($request->time),
            'location'          => $request->location,
            'description'       => $request->description,
            'contact_person'    => $request->contact_person,
            'organizer'         => $request->organizer,
        ]);

        if ($event) {
            return redirect()->route('schedule.index')->with([
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
     * @param  int  $id
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
