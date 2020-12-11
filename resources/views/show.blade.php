<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Post{{$post->id}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{\Illuminate\Support\Facades\Storage::url($post->image->path)}}" alt="Card image cap">
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
</body>
</html>
