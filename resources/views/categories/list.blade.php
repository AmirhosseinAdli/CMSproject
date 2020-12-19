@extends('layouts.app')
@section('content')
    <a href="{{route('categories.create')}}">ساخت دسته بندی</a>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Image</th>
        <th scope="col">Posts</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->title}}</td>
            <td><img src="{{$category->image->url}}" style="width: 10%;height: 10%"></td>
            <td>
                <table>
                    @forelse($category->posts as $post)
                        <tr>
                            Category{{$post->title}},
                        </tr>
                    @empty
                        @endforelse
                </table>
                        </td>
            <td>
                <form action="{{route('categories.show',[$category])}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm active">Show</button>
                </form>

                <form action="{{route('categories.destroy',[$category])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm active" onclick="return confirm('آیا از حذف این دسته بندی مطمپن هستید؟')">Delete</button>
                </form>
            </td>
                        </tr>
    @empty
    هنوز دسته بندی ندارید
    @endforelse
                        </tbody>
    {{$categories->links('pagination::bootstrap-4')}}
                </table>
@endsection
