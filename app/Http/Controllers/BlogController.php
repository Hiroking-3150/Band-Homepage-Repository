<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\User;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    
    
    public function index(Blog $blog)
    {
        return view('blogs.index')->with(['blogs' =>  $blog->getPaginateByLimit(3)]);
    }

    public function show(Blog $blog)
    {
        return view('blogs.show')->with(['blog' => $blog]);
    }

    public function create()
    {
        $user = User::all();
        // dd($user);
        return view('blogs.create')->with(['users' => $user]);
    }

    public function store(BlogRequest $request)
    {
        
        $input = $request->validated();  
        //  dd($input);

        
        $blog = new Blog();
        $blog->title = $input['blog']['title'];  
        $blog->body = $input['blog']['body'];   
        $blog->users_id = auth()->user()->id;  
        $blog->save();

        
        return redirect()->route('blog.posted')->with('success', 'ブログが作成されました！');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit')->with(['blog' => $blog]);
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $input_blog = $request['blog'];
        $blog->fill($input_blog)->save();

        return redirect('/blogs/' . $blog->id);
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        return redirect('/blogs');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id); 
        $blog->delete(); 

        return redirect()->route('blogs.index');
    }
}

?>
