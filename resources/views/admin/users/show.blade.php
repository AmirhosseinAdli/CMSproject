@extends('layouts.admin')

@section('content')
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">E-mail</th>
        <th scope="col">Mobile</th>
        <th scope="col">Posts</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->mobile}}</td>
            <td>{{$user->posts->count()}}</td>
            <td>

                <form action="{{route('admin.users.activation',[$user])}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm active" onclick="return confirm('آیا از غیر فعال کردن این کاربر مطمئن هستید؟')">
                        @if($user->activation == 1)
                            deactive
                        @else
                            active
                        @endif
                    </button>
                </form>

                <form action="{{route('admin.users.destroy',[$user])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm active" onclick="return confirm('آیا از حذف این کاربر مطمئن هستید؟')">Delete</button>
                </form>
            </td>
                        </tr>
                        </tbody>
                </table>
@endsection
