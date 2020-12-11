@extends('layouts.app')

@section('content')
    <form action="{{route('login')}}" method="post">
        @csrf
        <input type="hidden" name="mobile" value="{{$mobile}}">
        رمز: <input type="password" name="password"><br>
        <button type="submit">تایید</button>
    </form>
@endsection
