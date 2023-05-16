<!-- resources/views/posts/show.blade.php -->

@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->excerpt }}</p>
        {{-- <p>Author: {{ $post->author }}</p> --}}
        <p>Posted on: {{ $post->created_at }}</p>

        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
