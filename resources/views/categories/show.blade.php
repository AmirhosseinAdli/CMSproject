@extends('layouts.app')
@section('content')
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{$category->image->url}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{$category->title}}</h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Author: {{$category->author->name}}</li>
        <li class="list-group-item">Posts:
            <table>
                <tr>
            @foreach($category->posts as $post)
                {{$post->title}},
            @endforeach
                </tr>
            </table>
        </li>
        <li class="list-group-item">Created at: {{$category->created_at}}</li>
        <li class="list-group-item">Updated at: {{$category->updated_at}}</li>
    </ul>
</div>
@endsection
