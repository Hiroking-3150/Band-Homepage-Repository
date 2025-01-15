<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('news.create');
    }


    public function index(News $news)
    {
        return $news->get();
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'schedules_id' => 'nullable|integer', 
        ]);

        News::create([
            'title' => $request->title,
            'body' => $request->body,
            'schedules_id' => $request->schedules_id,
        ]);

        return redirect('/');
    }

    // public function edit(News $news)
    // {
    //     return view('news.edit', ['news' => $news]);
    // }
    public function edit($id)
    {
        $news = News::findOrFail($id);  

        return view('news.edit', compact('news'));  
    }



    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'schedules_id' => 'nullable|integer', 
        ]);

        $news->update([
            'title' => $request->title,
            'body' => $request->body,
            'schedules_id' => $request->schedules_id,
        ]);

        return redirect()->route('top')->with('status', 'ニュースが更新されました！');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect('/')->with('status', 'ニュースを削除しました！');
    }
    

}
