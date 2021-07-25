<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Schedule::all();

            return response()->json($data);
        }

        return view('schedule');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function action(Request $request)
    {
    
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $event = Schedule::create([
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end,
                ]);
            }
            if ($request->type == 'addPrivate') {
                $event = Schedule::create([
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end,
                    'user_id' => Auth::user()->id
                ]);
            }
            if ($request->type == 'update') {
                $event = Schedule::find($request->id)->update([
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end,
                ]);

                return response()->json($event);
            }

            if ($request->type == 'delete') {
                $event = Schedule::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }

    // public function ajax(Request $request)
    // {

    //     switch ($request->type) {
    //         case 'add':
    //             $event = Schedule::create([
    //                 'title' => $request->title,
    //                 'start' => $request->start,
    //                 'end' => $request->end,
    //             ]);

    //             return response()->json($event);
    //             break;

    //         case 'update':
    //             $event = Schedule::find($request->id)->update([
    //                 'title' => $request->title,
    //                 'start' => $request->start,
    //                 'end' => $request->end,
    //             ]);

    //             return response()->json($event);
    //             break;

    //         case 'delete':
    //             $event = Schedule::find($request->id)->delete();

    //             return response()->json($event);
    //             break;

    //         default:
    //             # code...
    //             break;
    //     }
    // }
}
