@extends('layouts.app')
@section('content')
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{$tag->title}}</h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Author: {{$tag->author->name}}</li>
        <li class="list-group-item">Posts:
            <table>
                <tr>
            @foreach($tag->posts as $post)
                {{$post->title}},
            @endforeach
                </tr>
            </table>
        </li>
        <li class="list-group-item">Created at: {{$tag->created_at}}</li>
        <li class="list-group-item">Updated at: {{$tag->updated_at}}</li>
    </ul>
</div>
@endsection
