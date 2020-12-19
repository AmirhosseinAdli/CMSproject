<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\DeclareDeclare;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->paginate(10);
        return view('posts.list',compact('posts'));
    }

    public function home()
    {
        $posts = Post::paginate(10);
        return view('posts.list',compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show')->withPost($post);
    }

    public function create()
    {
        $tags = auth()->user()->tags()->pluck('title','id');
        $categories = auth()->user()->categories()->pluck('title','id');
        return view('posts.create',compact('tags','categories'));
    }

    public function store(Request $request)
    {
        /**
         * @var Post $post
         * @var Image $image
         */
        $arr = ['title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => auth()->id(),
        ];
        $post = Post::create($arr);
        if ($request->has('tags')) {
            $post->tags()->sync($request->get('tags'));
        }
        if ($request->has('categories')) {
            $post->categories()->sync($request->get('categories'));
        }
        if ($request->has('image')) {
            $path = $request->file('image')->storePublicly('post');
            Image::create([
                'title' => $request->title,
                'alt' => "This is the image of post $request->title",
                'path' => $path,
                'imageable_id' => $post->id,
                'imageable_type' => Post::class,
            ]);
        }
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        Storage::delete($post->image->path);
        $post->image()->delete();
        $post->delete();
        return redirect()->route('posts.index');
    }
}
