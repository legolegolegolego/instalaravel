<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>{{ $post->title }}</title>
</head>
<body>
    <div class="container">
        <div class="post-details">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
            <p><strong>Published on:</strong> {{ $post->publish_date }}</p>
            <p><strong>Likes:</strong> {{ $post->n_likes }}</p>
            <p><strong>Author:</strong> {{ $post->user->name }}</p>

            <h2>Comments</h2>
            <div class="comments">
                @foreach ($post->comments ?? [] as $comment)
                    <div class="comment">
                        <p>{{ $comment->comment }}</p>
                        <small>Commented by {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}</small>
                    </div>
                @endforeach
            </div>

            @if (Auth::user()->id == $post->belongs_to)
                <form action="{{ route('delete-post', $post->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete-btn">Delete Post</button>
                </form>
            @endif
            <a href="{{ route('create-post') }}" class="btn create-post-btn">Create a post</a>
        </div>
    </div>
</body>
</html>
