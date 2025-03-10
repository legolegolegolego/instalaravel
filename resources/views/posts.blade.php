<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Posts</title>
</head>
<body>
    <div class="container">
        @foreach ($posts as $post)
            <div class="post-card">
                <a href="{{ route('post', $post->id) }}" class="post-title">
                    <h2>{{ $post->title }}</h2>
                </a>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="post-thumbnail">
                <p>{{ $post->description }}</p>
                <small>Posted on {{ $post->created_at->format('d M Y') }} by {{ $post->user->name }}</small>
                <p>Likes: {{ $post->n_likes }}</p>
                <form action="{{ route('like-post', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn like-btn">Like</button>
                </form>
                <div class="comments">
                    <h3>Comments:</h3>
                    <p>Number of comments: {{ $post->comments->count() }}</p>
                </div>
                <form action="{{ route('comment-form', ['id' => $post->id]) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn comment-btn">Comment on this post</button>
                </form>
                @if (Auth::user()->id == $post->belongs_to)
                    <form action="{{ route('delete-post', $post->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete-btn">Delete Post</button>
                    </form>
                @endif
            </div>
        @endforeach
        <a href="{{ route('create-post') }}" class="btn create-post-btn">Create a post</a>
        <a href="{{ route('deleteAccount') }}" class="btn delete-btn">Delete Account</a>
        <a href="{{ route('logout') }}" class="nav-link">Logout</a>
    </div>
</body>
</html>
