<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('list',compact('posts'));
    }

    public function show(Post $post)
    {
        return view('show')->withPost($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
