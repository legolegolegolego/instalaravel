<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Comment</title>
</head>
<body>
    <div class="container">
        <form action="{{ route('comment-post', $post->id) }}" method="POST" class="comment-form">
            @csrf
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
            </div>
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn primary-btn">Submit</button>
            <button type="button" class="btn secondary-btn" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
        </form>
    </div>
</body>
</html>
