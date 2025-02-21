<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <!-- TODO: Mostrar errores en el html, preguntar Diego -->
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <!-- Muestra de error en login -->
        @error('credentials')
            <div>{{ $message }}</div>
        @enderror
        <!--  -->
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>