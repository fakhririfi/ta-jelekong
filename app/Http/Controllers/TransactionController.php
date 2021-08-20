<?php

namespace App\Http\Controllers;

use App\Event;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $events = Event::all();

        if ($request->query('event_id') != null || $request->query('status') != null) {
            $transactions = Transaction::where(function ($query) use ($request) {
                if ($request->query('event_id') != null) {
                    $query->where('event_id', $request->query('event_id'));
                }

                if ($request->query('status') != null) {
                    if ($request->query('status') == 'paid') {
                        $query->where('status', 'paid');
                    } else {
                        $query->where('status', '!=', 'paid');
                    }
                }
            })->get();
        } else {
            $transactions = Transaction::all();
        }

        return view('admin.transactions.index')->with([
            'transactions' => $transactions,
            'events' => $events
        ]);
    }

    public function dashboard(Request $request)
    {
        $year = Carbon::now()->year;
        if ($request->query('year') != null) {
            $year = $request->query('year');
        }

        $transactions = Transaction::with('event')
            ->select('event_id', DB::raw('sum(ticket) as total'))
            ->groupBy('event_id')
            ->orderBy('total', 'DESC')
            ->whereYear('created_at', $year)
            ->get();

        $events = [];
        $eventTotal = [];
        $eventName = [];
        foreach ($transactions as $transaction) {
            $event = Event::find($transaction->event_id);
            array_push($events, $event);
            array_push($eventTotal, $transaction->total);
            array_push($eventName, $event->name);
        }

        return view('admin.transactions.dashboard')->with([
            'transactions' => $transactions,
            'events' => $events,
            'eventsTotal' => json_encode($eventTotal), 
            'eventsName' => json_encode($eventName)
        ]);
    }

    public function confirmation_admin($code)
    {
        Transaction::where('code', $code)->update([
            'status' => 'paid'
        ]);

        return redirect()->back();
    }

    public function eticket($code)
    {
        $transaction =  Transaction::where('code', $code)->first();

        if ($transaction->status != 'paid') {
            return redirect()->back()->withErrors([
                'code' => 'harus bayar dulu'
            ]);
        }

        return view('customer.transactions.eticket')->with([
            'transaction' => $transaction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    /* search ticket customer */
    public function ticketing()
    {
        return view('customer.transactions.ticketing');
    }

    /* search ticket process */
    public function ticketing_search(Request $request)
    {
        $this->validate($request, [
            'code' => 'required'
        ]);

        $transaction = Transaction::where('code', $request->code)->first();

        if (!$transaction) {
            return redirect()->back()->withErrors([
                'code' => 'code tidak ditemukan'
            ]);
        }

        return redirect(route('customer.transactions.ticketing.show', $request->code));
    }

    /* show ticket after search */
    public function ticketing_show($code)
    {
        $transaction = Transaction::where('code', $code)->first();

        if (!$transaction) {
            return redirect()->back()->withErrors([
                'code' => 'code tidak ditemukan'
            ]);
        }

        return view('customer.transactions.show')->with([
            'transaction' => $transaction
        ]);
    }

    /* Show confirmation page */
    public function confirmation(Request $request, $event_id)
    {
        $event = Event::find($event_id);

        if($event->quota < $request->ticket){
            return redirect()->back()->withErrors([
                'ticket' => 'kuota tidak cukup'
            ]);
        }

        Event::where('id', $event_id)->update([
            'quota' => $event->quota - $request->ticket
        ]);

        return view('customer.transactions.confirmation')->with([
            'event' => $event
        ]);
    }

    /* Insert transaction data from confirmation page */
    public function confirmation_process(Request $request, $event_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'ticket' => 'required'
        ]);

        //generate token
        $code = null;
        do {
            $code = mb_strtoupper(substr(md5(microtime()), rand(0, 26), 8));
            $transaction = Transaction::where('code', $code)->first();
        } while ($transaction != null);


        //insert new transaction
        $event = Event::find($event_id);
        $transaction = Transaction::create([
            'event_id' => $event->id,
            'code' => $code,
            'ticket' => $request->ticket,
            'ticket_price' => $event->price,
            'amount' => ($event->price * $request->ticket) + 2000,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'checkout'
        ]);

        return redirect(route('customer.transactions.checkout', $code));
    }

    /* show checkout page */
    public function checkout($code)
    {
        $transaction = Transaction::where('code', $code)->first();

        return view('customer.transactions.checkout')->with([
            'transaction' => $transaction
        ]);
    }

    /* checkout process */
    public function checkout_process($code)
    {
        Transaction::where('code', $code)->update([
            'status' => 'payment'
        ]);

        return redirect(route('customer.transactions.payment', $code));
    }

    /* show payment page */
    public function payment($code)
    {
        $transaction = Transaction::where('code', $code)->first();

        return view('customer.transactions.payment')->with([
            'transaction' => $transaction
        ]);
    }

    /* payment process */
    public function payment_process(Request $request, $code)
    {
        $this->validate($request, [
            'proof' => 'required|mimes:pdf,jpg,jpeg,png',
        ]);

        $path = $request->file('proof')->store('transactions', 'public');

        Transaction::where('code', $code)->update([
            'status' => 'checking',
            'proof' => $path
        ]);

        return redirect(route('customer.transactions.ticketing'));
    }

    /* payment cancel */
    public function payment_cancel(Request $request, $code)
    {

        $transaction = Transaction::where('code', $code)->first();
        $event = Event::find($transaction->event_id);

        $event->update([
            'quota' => $event->quota + $transaction->ticket
        ]);

        $transaction->delete();

        return redirect('/');
    }
}