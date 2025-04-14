<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('Super_Admin.blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('Super_Admin.blogs.view', compact('blog'));
    }

    public function create()
    {
        return view('Super_Admin.blogs.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable',
        ]);

        $blog = Blog::create($validatedData);

        if ($request->hasFile('featured_image')) {
            $blog->featured_image = $request->file('featured_image')->store('blog_images');
            $blog->save();
        }

        return redirect()->route('blogs.index');
    }
    
    public function delete($id)
    {
        // Delete the post with the given ID
        Blog::find($id)->delete();

        // Redirect to the index page
        return redirect()->route('blogs.index');
    }
    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('Super_Admin.blogs.edit')->with([
            'blog' => $blog
        ]); 
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' =>'required',
            'content' =>'required',
            'featured_image' => 'nullable',
        ]);
        
        $blog = Blog::findOrFail($id);

        $blog->title=$request->title;
        $blog->content=$request->content;
        $blog->save();

        if ($request->hasFile('featured_image')) {
            $blog->featured_image = $request->file('featured_image')->store('blog_images');
            $blog->save();
        }

        return redirect()->route('blogs.index',$id);

    }

}
