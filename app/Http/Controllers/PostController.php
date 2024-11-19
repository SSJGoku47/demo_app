<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $postQuery = Post::with('user')->orderBy('created_at', 'desc');
    
        // Apply filter for published or unpublished posts based on the request

        if ($request->has('show_unpublished') && $request->show_unpublished) {
            $postQuery->where('is_published', false);
        } else {
            $postQuery->where('is_published', true);
        }
    
        // Paginate

        $posts = $postQuery->paginate(10);

        return view('post.index', compact('posts'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        try {
            $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',
            ]);

            $user = Auth::user();
            $createPost = new Post();   
            $createPost->title = $request->title;
            $createPost->content = $request->content;
            $createPost->description = $request->description;
            $createPost->is_published = $request->is_published;
            $createPost->user_id = $user->id;
            $createPost->save();

            session()->flash('success', 'Post Created successfully!');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            \Log::error('Login error: ' . $e->getMessage());
            return redirect()->route('post.create')->withInput();
        }

        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {   
        try {
            $request->validate([
                'title' => 'required|string',
                'content' => 'required|string',
            ]);

            $updatePost = Post::findOrFail($post->id);   
            $updatePost->title = $request->title;
            $updatePost->content = $request->content;
            $updatePost->description = $request->description;
            $post->is_published = $request->has('is_published') ? 1 : 0;
            $updatePost->save();

            $post->update($request->all());
            session()->flash('success', 'Post Updated successfully!');
            return redirect()->route('post.index');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            \Log::error('Login error: ' . $e->getMessage());
            return redirect()->route('post.create')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index')->with('error', 'Post deleted successfully.');
    }
}
