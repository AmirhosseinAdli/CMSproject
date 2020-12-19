@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ساخت پست</h1>

        @if(session('error'))
            <p class="text-danger">{{session('error')}}</p>
        @endif

        <form action="{{  route('posts.store')  }}" method="post" enctype="multipart/form-data">
            @csrf
{{--            <input type="hidden" name="activation" value="1">--}}
            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="content">محتوا</label>
                <textarea name="content" id="content" cols="30" rows="10" class="col-12"></textarea>
                @error('content') <p class="m-0">{{$message}}</p> @enderror
            </div>

            <div class="form-group">
                <select name="tags[]" class="custom-select" multiple>
                    @forelse($tags as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <select name="categories[]" class="custom-select" multiple>
                    @forelse($categories as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label for="image">تصویر</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image') <p class="m-0">{{$message}}</p> @enderror
            </div>

            <button type="submit" class="btn btn-primary">ساخت پست</button>
        </form>
    </div>
@endsection
