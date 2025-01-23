<!DOCTYPE html>
<html>

<head>
    <title>EDITAR USUARI</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    h2{
        margin-left: 20%;
    }

    form{
        margin-left: 20%;
        margin-right: 20%;
    }

    .d-flex{
        margin-right: 20%;
    }
</style>

<body>

<!-- Mostrar mensaje de error general -->

@extends('adminlte::page')

@section('title', 'EDITAR USUARI')

@section('content')

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botó per tornar enrere -->
    <div class="d-flex justify-content-end">
        <a href="{{ route('usuaris.index') }}" class="btn btn-secondary" style="margin-top: 3%">Tornar</a>
    </div>

    <!-- Editar un usuari -->
    <h2 class="mt-5">Editar Usuari</h2>
    <form action="{{ route('usuaris.update', $usuari) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="usuari">Nom:</label>
            <input type="text" name="usuari" class="form-control" value="{{ $usuari->usuari }}" required>
        </div>
        <div class="form-group">
            <label for="correu">Correu:</label>
            <input type="email" name="correu" class="form-control" value="{{ $usuari->correu }}" required>
        </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" class="form-control" required>
                <option value="admin" {{ (isset($usuari) && $usuari->rol === 'admin') ? 'selected' : '' }}>Administrador</option>
                <option value="usuari" {{ (isset($usuari) && $usuari->rol === 'usuari') ? 'selected' : '' }}>Usuari</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password_actual">Contrasenya de l'administrador:</label>
            <input type="password" name="password_actual" class="form-control"
                   placeholder="Introdueix la teva contrasenya" required>
            @error('password_actual')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 2%">Actualitzar</button>
    </form>

@endsection

</body>

</html>
