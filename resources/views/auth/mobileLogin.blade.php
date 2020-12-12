@extends('layouts.app')

@section('content')
    @if(session('status'))
        <div>
            {{session('status')}}
        </div>
    @endif
    <form action="{{route('validation')}}" method="post">
        @csrf
        موبایل: <input type="text" name="mobile"><br>
        <button type="submit">تایید</button>
    </form>
@endsection
