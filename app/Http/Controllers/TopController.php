<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function top()
    {
        $news = News::latest()->get();

        return view('top.top', compact('news'));
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

}
