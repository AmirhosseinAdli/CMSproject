@extends('layouts.app')

@section('content')
    <form action="{{route('validation')}}" method="post">
        @csrf
        موبایل: <input type="text" name="mobile"><br>
        <button type="submit">تایید</button>
    </form>
@endsection
