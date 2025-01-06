<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(News $news)
    {
        return $news->get();
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'schedules_id' => 'nullable|integer', // スケジュールIDは任意
        ]);

        News::create([
            'title' => $request->title,
            'body' => $request->body,
            'schedules_id' => $request->schedules_id,
        ]);

        return redirect('/');
    }
}
