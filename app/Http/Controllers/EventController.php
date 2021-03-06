<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $request->start = $request->time;

        if ($request->ajax()) {
            $data = Event::select(['time as start', 'name as title', 'schedule as editable', 'events.*'])->get();

            return response()->json($data);
        }
        $events = Event::where('schedule', false)->get();
        $events = [];
        if ($request->query('year') != null) {
            $events = Event::whereYear('time', $request->query('year'))
                ->get();
        } else {
            $events = Event::where('schedule', false)->get();
        }

        return view('admin.events.index')->with([
            'events' => $events
        ]);
    }

    /**
     * Display a listing of the resource for customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_customer(Request $request)
    {
        $current_events = Event::where('schedule', false)->whereBetween('time', [Carbon::now(), Carbon::now()->addWeek(1)])->get();
        $future_events = Event::where([['time', '>', Carbon::now()->addWeek(1)], ['schedule', false]])->get();

        $filtered_events = [];
        if ($request->query('month') != null) {
            $filtered_events = Event::whereMonth('time', $request->query('month'))->where('schedule', false)->get();
        }

        return view('customer.events.index')->with([
            'current_events' => $current_events,
            'future_events' => $future_events,
            'filtered_events' => $filtered_events
        ]);
    }

    public function dashboard(Request $request)
    {

        //month count
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $countData = [];
        $year = Carbon::now()->year;
        if ($request->query('year') != null) {
            $year = $request->query('year');
        }
        foreach ($months as $month) {
            $event = Event::whereMonth('time', $month)
                ->whereYear('time', $year)
                ->count();
            array_push($countData, $event);
        }

        //organizer count
        $events = Event::select('organizer', DB::raw('count(*) as total'))
            ->groupBy('organizer')
            ->whereYear('time', $year)
            ->get();

        $organizer = [];
        $organizerCount = [];
        foreach ($events as $event) {
            array_push($organizer, $event->organizer);
            array_push($organizerCount, $event->total);
        }

        //category
        $categories = ['Tari', 'Pentas Musik', 'Teater', 'Pameran', 'Webinar', 'Seminar'];
        $categoryData = [];
        foreach ($categories as $category) {
            $event = Event::where('category', $category)
                ->whereYear('time', $year)
                ->count();
            array_push($categoryData, $event);
        }

    //administrator counts
    $administrator_count = 0;
    $events = Event::whereYear('time', $year)
        ->get();
    foreach ($events as $event) {
        $administrator_count += $event->administrator_count;
    }

        return view('admin.events.dashboard')->with([
            'countData' => json_encode($countData),
            'organizer' => json_encode($organizer),
            'organizerCount' => json_encode($organizerCount),
            'categories' => json_encode($categories),
            'categoryData' => json_encode($categoryData),
            'administrator_count' => $administrator_count,
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
            'category' => 'required',
            'contact_person' => 'required',
            'quota' => 'required',
            'image' => 'required',
            'organizer' => 'required',
            'type' => 'required',
            'administrator_count' => 'required',
            'administrators' => 'required'
        ]);

        $path = $request->file('image')->store('events', 'public');

        $event = Event::create([
            'name' => $request->name,
            'time' => Carbon::parse($request->time),
            'category' => $request->category,
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
            'contact_person' => $request->contact_person,
            'quota' => $request->quota,
            'organizer' => $request->organizer,
            'image' => $path,
            'user_id' =>  $request->user()->id,
            'type' => $request->type,
            'administrator_count' => $request->administrator_count,
            'administrators' => $request->administrators
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
        if (!$event) {
            return redirect()->back()->withErrors([
                'events' => 'data tidak ditemukan'
            ]);
        }
        $event->time = Carbon::parse($event->time)->format('Y/m/d H:m');
        $event->end = Carbon::parse($event->end)->format('Y/m/d H:m');
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
            'category' => 'required',
            'contact_person' => 'required',
            'organizer' => 'required',
            'price' => 'required',
            'quota' => 'required',
            'type' => 'required',
            'administrator_count' => 'required',
            'administrators' => 'required'
        ]);

        $path = $event->image;
        if (isset($request->image)) {
            $path = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'name' => $request->name,
            'time' => Carbon::parse($request->time),
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'contact_person' => $request->contact_person,
            'organizer' => $request->organizer,
            'quota' => $request->quota,
            'image' => $path,
            'type' => $request->type,
            'administrator_count' => $request->administrator_count,
            'administrators' => $request->administrators
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
    public function action(Request $request)
    {


        if ($request->ajax()) {
            if ($request->type == 'update') {
                $event = Event::find($request->id)->update([
                    'time'        =>    $request->start,
                    'end'        =>    $request->end,
                ]);
                return response()->json($event);
            }
        }
    }
    public function isTanggalMerah(Request $request)
    {

        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"), true);

        if (isset($array[$request->tanggal])) {
            return response()->json(['merah' => true, 'data' => $array[$request->tanggal]]);
        }
        return response()->json(['merah' => false]);
    }
}
