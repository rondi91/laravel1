@extends('layouts.main')
<!-- resources/views/posts/index.blade.php -->



@section('content')
    <div class="container">
        <h1>Posts</h1>
        <div class="col-md-6">
            <div class="mb-3" witd>
                <form action="{{ route('posts.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                        @php
                        $number = ($posts->currentPage() - 1) * $posts->perPage() + 1;
                    @endphp
                    @foreach ($posts as $post)
                <tr>
                        <td>{{ $number++ }}</td>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    </div>
@endsection
