@extends('layouts.app')
@section('content')
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
    @forelse($posts as $post)
        <tr @if($post->deleted_at) bgcolor="red" @endif>
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
                @if(is_null($post->deleted_at))
                <td>
                <form action="{{route('posts.show',[$post])}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm active">Show</button>
                </form>

                <form action="{{route('posts.destroy',[$post])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm active" onclick="return confirm('آیا از حذف این پست مطمپن هستید؟')">Delete</button>
                </form>
                </td>
                @else
                    <td>
                    <form action="{{route('posts.restore',$post)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm active">Restore</button>
                    </form>

                    <form action="{{route('posts.terminate',$post)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm active" onclick="return confirm('آیا از حذف کامل این پست مطمپن هستید؟')">Terminate</button>
                    </form>
                    </td>
            @endif
                        </tr>
    @empty
                        @endforelse
                        </tbody>
    {{$posts->links('pagination::bootstrap-4')}}
                </table>
@endsection
