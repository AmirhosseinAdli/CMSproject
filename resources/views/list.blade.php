<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Posts</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Author</th>
        <th scope="col">Categories</th>
        <th scope="col">Tags</th>
        <th scope="col">Options</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->slug}}</td>
            <td>{{$post->author->name}}</td>
            <td>
                <table>
                    @foreach($post->categories as $category)
                        <tr>
                            Category{{$category->id}},
                        </tr>
                        @endforeach
                </table>
                        </td>
            <td>
                <table>
                    @foreach($post->tags as $tag)
                        <tr style="border: solid 2px black">
                            Tag{{$tag->id}},
                        </tr>
                        @endforeach
                </table>
                        </td>
            <td>
                <form action="{{route('posts.show',[$post])}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm active">Show</button>
                </form>

                <form action="{{route('posts.destroy',[$post])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm active">Delete</button>
                </form>

            </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
</body>
</html>
