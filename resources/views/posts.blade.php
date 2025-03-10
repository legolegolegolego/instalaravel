<!-- VIEW PRINCIPAL DE UN LOGUEADO -->
<!-- APARECEN TODOS LOS POSTS DE TODOS LOS USERS POR ORDEN -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    @foreach ($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->description }}</p>
            <small>Posted on {{ $post->created_at->format('d M Y') }} by {{ $post->user->name }}</small>
            <p>Likes: {{ $post->n_likes }}</p>
            <div class="comments">
            <h3>Comments:</h3>
            <!-- si no tiene comentarios el post muestra un array vacío -->
            @foreach ($post->comments ?? [] as $comment)
                <div class="comment">
                <p>{{ $comment->comment }}</p>
                <small>Commented by {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}</small>
                </div>
            @endforeach
            </div>
            <form action="{{ route('delete-post', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Post</button>
            </form>
            <!-- Redirección al form para comentar pasándole el id del post en cuestion -->
            <a href="{{ route('comment-form', ['id' => $post->id]) }}">Comment on this post</a>
        </div>
    @endforeach
    <a href="{{ route('create-post') }}">Create a post</a>
</body>
</html>