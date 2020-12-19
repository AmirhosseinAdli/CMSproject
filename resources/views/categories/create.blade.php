@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ساخت تگ</h1>

        @if(session('error'))
            <p class="text-danger">{{session('error')}}</p>
        @endif

        <form action="{{  route('categories.store')  }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="image">تصویر</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">ساخت تگ</button>
        </form>
    </div>
@endsection
