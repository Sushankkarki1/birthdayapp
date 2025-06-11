<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|min:1|max:1000'
        ]);

        Post::create([
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);

        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'body' => 'required|min:1|max:1000'
        ]);

        $post->update(['body' => $request->body]);

        return redirect('/')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully!');
    }
}
