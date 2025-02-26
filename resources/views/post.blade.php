<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
</head>
<body>
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->description }}</p>
        <p><strong>Published on:</strong> {{ $post->publish_date }}</p>
        <p><strong>Likes:</strong> {{ $post->n_likes }}</p>
        <p><strong>Author:</strong> {{ $post->user->name }}</p>

        <h2>Comments</h2>
        <div class="comments">
            @foreach($post->comments as $comment)
                <div class="comment">
                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                    <p><small>Posted on: {{ $comment->created_at }}</small></p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
