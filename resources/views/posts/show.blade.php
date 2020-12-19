@extends('layouts.app')
@section('content')
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{$post->image->url}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{$post->title}}</h5>
        <p class="card-text">{{$post->content}}</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Slug: {{$post->slug}}</li>
        <li class="list-group-item">Author: {{$post->author->name}}</li>
        <li class="list-group-item">Categories:
            <table>
                <tr>
            @foreach($post->categories as $category)
                {{$category->title}},
            @endforeach
                </tr>
            </table>
        </li>
        <li class="list-group-item">Tags:
            <table>
                <tr>
            @foreach($post->tags as $tag)
                {{$tag->title}},
            @endforeach
                </tr>
            </table>
        </li>
        <li class="list-group-item">Created at: {{$post->created_at}}</li>
        <li class="list-group-item">Updated at: {{$post->updated_at}}</li>
    </ul>
</div>
@endsection
