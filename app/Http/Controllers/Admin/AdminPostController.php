<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.list',compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        return view('admin.posts.show')->withPost($post);
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function activation(Post $post)
    {
        $post->activation = !$post->activation;
        $post->update();
        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
