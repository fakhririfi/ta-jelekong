<?php

namespace App\Http\Controllers;

use App\Article;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('admin.articles.index')->with([
            'articles' => $articles
        ]);

    }

    public function index_customer()
    {
        $articles = Article::whereDate('post_date', '<=', Carbon::now())
        ->get();

        return view('customer.articles.index')->with([
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $events = Event::all();

        return view('admin.articles.create')->with([
            'events' => $events
        ]);
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'time' => 'required'
        ]);

        $path = $request->file('image')->store('articles', 'public');

        $event_id = null;
        if(isset($request->event_id)){
            $event_id = $request->event_id;
        }

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'event_id' => $event_id,
            'post_date' => Carbon::parse($request->time)
            
        ]);

        if ($article) {
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
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    public function show_customer($id)
    {
        $article = Article::find($id);

        if(!Carbon::parse($article->post_date)->isPast()){
            return redirect(route('customer.articles.index'))->withErrors([
                'error' => 'Tidak dapat membuka artikel'
            ]);
        }

        $event = null;
        if($article->event_id != null){
            $event = Event::find($article->event_id);
        }

        return view('customer.articles.show')->with([
            'article' => $article,
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if(!$article){
            return redirect()->back()->withErrors([
                'events' => 'data tidak ditemukan'
            ]);
        }

        $events = Event::all();

        return view('admin.articles.edit')->with([
            'article' => $article,
            'article' => $article,
            'events' => $events
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
             'time' => 'required'
        ]);

        $path = $article->image;
        if(isset($request->image)){
            $path = $request->file('image')->store('events', 'public');
        }

        $event_id = null;
        if(isset($request->event_id)){
            $event_id = $request->event_id;
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'event_id' => $event_id,
            'post_date' => Carbon::parse($request->time)
        
        ]);

        if ($article) {
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
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->back()->with([
            'success' => "Berhasil Menghapus $article->title"
        ]);
    }
}
