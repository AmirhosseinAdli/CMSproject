@extends('layouts.app')
@section('content')
    <a href="{{route('tags.create')}}">ساخت تگ</a>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Posts</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($tags as $tag)
        <tr>
            <th scope="row">{{$tag->id}}</th>
            <td>{{$tag->title}}</td>
            <td>
                <table>
                    @forelse($tag->posts as $post)
                        <tr>
                            Category{{$post->title}},
                        </tr>
                    @empty
                        @endforelse
                </table>
                        </td>
            <td>
                <form action="{{route('tags.show',[$tag])}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm active">Show</button>
                </form>

                <form action="{{route('tags.destroy',[$tag])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm active" onclick="return confirm('آیا از حذف این تگ مطمپن هستید؟')">Delete</button>
                </form>
            </td>
                        </tr>
    @empty
    هنوز تگی ندارید
    @endforelse
                        </tbody>
    {{$tags->links('pagination::bootstrap-4')}}
                </table>
@endsection
