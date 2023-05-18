

@extends('layouts.main')
<!-- resources/views/posts/show.blade.php -->

<!-- resources/views/posts/show.blade.php -->



@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
       
        <p>Author: {{ $post->author }}</p>
        <p>Created at: {{ $post->created_at }}</p>
        <p>Updated at: {{ $post->updated_at }}</p>

        <div class="code-box mb-3">
            <pre><code class="Box-sc-g0xbh4-0 giEfVQ" >{{ $post->body }}</code></pre>
            <button class="btn btn-secondary copy-code-btn" data-clipboard-text="{{ $post->body }}">
                <i class="fas fa-copy"></i> Copy Code
            </button>
            <span class="code-copy-success text-success d-none">Code copied!</span>
        </div>

        <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script>
        // Script to initialize clipboard.js
        const clipboard = new ClipboardJS('.copy-code-btn');

        clipboard.on('success', function(e) {
            const successMessage = document.querySelector('.code-copy-success');
            successMessage.classList.remove('d-none');
            setTimeout(function() {
                successMessage.classList.add('d-none');
            }, 2000);

            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            console.error('Failed to copy code:', e);
        });
    </script>
@endsection
