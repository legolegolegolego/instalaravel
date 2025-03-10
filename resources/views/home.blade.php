<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <a href="{{ route('posts') }}">Enter</a>
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
    <a href="{{ route('logout') }}">Logout</a>
    <a href="{{ route('deleteAccount') }}">Delete Account</a>
    <a href="{{ route('create-post') }}">Create post</a>
</body>
</html>