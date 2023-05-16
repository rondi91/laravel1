@extends('layouts.main')



@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label for="excerpt">excerpt</label>
            <textarea name="excerpt" id="excerpt" class="form-control">{{ $post->excerpt }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
