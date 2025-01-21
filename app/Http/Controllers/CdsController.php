<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cd;
use App\Models\Song;
use Cloudinary;


class CdsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');

    //     $this->middleware(function ($request, $next) {
    //             if (auth()->check() && auth()->user()->is_admin !== 1) {
    //             //if (auth()->user()->is_admin !== 1) {
    //             //return redirect('/')->with('error', 'You are not authorized to access this page.');
    //             return view('auth.register_blocked');
    //         }
    //         return $next($request);
    //     });
    // }


    public function index()
    {
        $cds = Cd::all();
        return view('cds.index', ['cds' => $cds]);
    }

    public function show($id)
    {
        $cd =Cd::with('songs')->findOrFail($id);
        return view('cds.show', ['cd' => $cd]);
    }

    public function create()
    {
        return view('cds.create');
    }


    public function store(Request $request)
    {
        $image_url = Cloudinary::upload($request->file('cover_image')->getRealPath())->getSecurePath();
        //dd($image_url);

        $cd = new Cd();
        $cd->title = $request->input('title');
        $cd->release_date = $request->input('release_date');
        $cd->cover_image = $image_url;
        $cd->save();

        if ($request->songs) {
            foreach ($request->songs as $song) {
                Song::create([
                    'title' => $song['title'],
                    'cd_id' => $cd->id,
                ]);
            }
        }

        return redirect('/cds/' . $cd->id);
    }
}
