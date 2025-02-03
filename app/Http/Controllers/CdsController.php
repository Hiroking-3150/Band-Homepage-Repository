<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cd;
use App\Models\Song;
use Cloudinary;
use Cloudinary\Configuration\Environment;
use Cloudinary\Configuration\Configuration;


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

        $isAdmin = auth()->check() ? auth()->user()->is_admin : false;

        return view('cds.show', compact('cd', 'isAdmin'));
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

    public function edit($cd)
    {
        $cd = Cd::findOrFail($cd);
        $songs = $cd->songs;

        return view('cds.edit', compact('cd', 'songs'));
    }

    public function update(Request $request, $cd)
    {
        // バリデーション
        $validated = $request->validate([
            'title' => 'required|max:255',
            'release_date' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // cdsテーブルからディスコグラフィー情報を取得
        $cd = Cd::findOrFail($cd);

        // ディスコグラフィー情報の更新
        $cd->title = $validated['title'];
        $cd->release_date = $validated['release_date'];

        if ($request->hasFile('cover_image')) {
            $uploadedImage = Cloudinary::upload($request->file('cover_image')->getRealPath());
            $cd->cover_image = $uploadedImage->getSecurePath(); // Cloudinaryから返されたURLを保存
        }

        // 更新を保存
        $cd->save();

        if ($request->has('songs')) {
            foreach ($request->songs as $index => $songData) {
                if (isset($songData['title'])) {
                    if (isset($cd->songs[$index])) {
                        // 既存の曲を更新
                        $cd->songs[$index]->title = $songData['title'];
                        $cd->songs[$index]->save();
                    } else {
                        // 新しい曲を追加
                        $cd->songs()->create([
                            'title' => $songData['title'],
                        ]);
                    }
                }
            }
        }

        // 更新後のページにリダイレクト
        return redirect()->route('cds.index')->with('success', 'ディスコグラフィーが更新されました');
    }

    public function destroySong($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();

        return back();
    }

    public function destroy($id)
    {
        $cd = Cd::findOrFail($id);

        // CDの削除
        $cd->delete();

        return redirect()->route('cds.index')->with('success', 'ディスコグラフィーが削除されました');
    }



}
