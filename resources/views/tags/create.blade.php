@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ساخت تگ</h1>

        @if(session('error'))
            <p class="text-danger">{{session('error')}}</p>
        @endif

        <form action="{{  route('tags.store')  }}" method="post" enctype="multipart/form-data">
            @csrf
{{--            <input type="hidden" name="activation" value="1">--}}
            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <button type="submit" class="btn btn-primary">ساخت تگ</button>
        </form>
    </div>
@endsection
