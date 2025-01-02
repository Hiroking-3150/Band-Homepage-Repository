<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Blog $blog)
    {
        return view('blogs.index')->with(['blogs' =>  $blog->getPaginateByLimit(3)]);
    }

    public function show(Blog $blog)
    {
        return view('blogs.show')->with(['blog' => $blog]);
    }
}

?>
