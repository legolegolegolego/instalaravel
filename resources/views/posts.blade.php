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
            <p>{{ $post->body }}</p>
            <small>Posted on {{ $post->created_at->format('d M Y') }} by {{ $post->user->name }}</small>
        </div>
    @endforeach
</body>
</html>