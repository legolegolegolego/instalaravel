<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Home</h1>
        <div class="nav-links">
            <a href="{{ route('posts') }}" class="nav-link">Enter</a>
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <a href="{{ route('register') }}" class="nav-link">Register</a>
        </div>
    </div>
</body>
</html>
