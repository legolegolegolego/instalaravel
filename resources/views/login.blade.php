@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>Email</label>
        <input type="email" name="email" required>
        
        <label>Contraseña</label>
        <input type="password" name="password" required>
        
        <button type="submit">Entrar</button>
    </form>
</div>
@endsection
