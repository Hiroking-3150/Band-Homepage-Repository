<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cd;

class CdsController extends Controller
{
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
}
