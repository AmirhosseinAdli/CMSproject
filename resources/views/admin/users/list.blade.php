@extends('layouts.admin')

@section('content')
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">E-mail</th>
        <th scope="col">Mobile</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr @if($user->activation == 0)
            bgcolor="yellow"
            @endif>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->mobile}}</td>
            <td>
                <form action="{{route('admin.users.show',[$user])}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm active">Show</button>
                </form>

{{--                <form action="{{route('posts.destroy',[$post])}}" method="post">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger btn-sm active" onclick="return confirm('آیا از حذف این پست مطمپن هستید؟')">Delete</button>--}}
{{--                </form>--}}
            </td>
                        </tr>
                        @endforeach
                        </tbody>
    {{$users->links('pagination::bootstrap-4')}}
                </table>
@endsection
