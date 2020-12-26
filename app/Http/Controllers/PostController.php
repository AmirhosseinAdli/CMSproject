<?php

namespace App\Http\Controllers;

use App\Mail\DeletePost;
use App\Mail\PublishPost;
use App\Mail\TerminatePost;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\DeclareDeclare;

class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class,'post');
    }

    public function index()
    {
        $posts = auth()->user()->posts()->withTrashed()->paginate(10);
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
//        $user = User::first();
//        $user2 = User::find(2);
//        dd($user2->can("delete-{$user->getRoleNames()->first()}"));
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
        ];$post = Post::create($arr);if ($request->has('tags')) {$post->tags()->sync($request->get('tags'));
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
        $post->image()->delete();
        $post->delete();
        Mail::to(auth()->user()->email)->send(new DeletePost($post));
        return redirect()->route('posts.index');
    }

    public function restore($post)
    {
        Image::withTrashed()->where('imageable_type',Post::class)->where('imageable_id',$post)->restore();
        Post::withTrashed()->find($post)->restore();
        return redirect()->route('posts.index');
    }

    public function terminate($post)
    {
        Storage::delete(Image::withTrashed()->where('imageable_type',Post::class)->where('imageable_id',$post)->get()->toArray()[0]['path']);
        Image::withTrashed()->where('imageable_type',Post::class)->where('imageable_id',$post)->forceDelete();
        $post1 = Post::withTrashed()->find($post);
        Post::withTrashed()->find($post)->forceDelete();
        Mail::to(auth()->user()->email)->send(new TerminatePost($post1));
        return redirect()->route('posts.index');
    }

    public function draftPosts()
    {
        $posts = auth()->user()->posts()->where('activation',0)->paginate(10);
        return view('posts.draft',compact('posts'));
    }

    public function deletedPosts()
    {
        $posts = auth()->user()->posts()->onlyTrashed()->paginate(10);
//        $posts = auth()->user()->posts()->where('deleted_at','!=',null);
        return view('posts.deleted',compact('posts'));
    }
    public function activation(Post $post)
    {
        if(Gate::allows('publish-post')) {
            $post->activation = !$post->activation;
            $post->update();
            Mail::to($post->author()->email)->send(new PublishPost($post));
            return redirect()->route('admin.posts.index');
        }
        return abort(404);
    }
}
