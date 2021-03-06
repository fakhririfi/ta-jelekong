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
            'name'              => 'required|max:255',
            'time'              => 'required',
            'end'               => 'required',
            'location'          => 'required|max:255',
            'description'       => 'required',
            'contact_person'    => 'required|max:255',
            'organizer'         => 'required|max:255'
        ]);

        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"), true);
        if (isset($array[Carbon::parse($request->time)->format('Ymd')])) {
            return redirect()->back()->withErrors([
                'error' => 'Tanggal Merah'
            ]);
        }
        if (isset($array[Carbon::parse($request->end)->format('Ymd')])) {
            return redirect()->back()->withErrors([
                'error' => 'Tanggal Merah'
            ]);
        }

        $event = Event::create([
            'name'              => $request->name,
            'time'              => Carbon::parse($request->time),
            'end'               => Carbon::parse($request->end),
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
        $event->time = Carbon::parse($event->time)->format('Y/m/d H:m');
        $event->end = Carbon::parse($event->end)->format('Y/m/d H:m');
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
            'name'              => 'required|max:255',
            'time'              => 'required',
            'end'               => 'required',
            'location'          => 'required|max:255',
            'description'       => 'required',
            'contact_person'    => 'required|max:255',
            'organizer'         => 'required|max:255'
        ]);

        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"), true);
        if (isset($array[Carbon::parse($request->time)->format('Ymd')])) {
            return redirect()->back()->withErrors([
                'error' => 'Tanggal Merah'
            ]);
        }
        if (isset($array[Carbon::parse($request->end)->format('Ymd')])) {
            return redirect()->back()->withErrors([
                'error' => 'Tanggal Merah'
            ]);
        }

        $event->update([
            'name'              => $request->name,
            'time'              => Carbon::parse($request->time),
            'end'               => Carbon::parse($request->end),
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
