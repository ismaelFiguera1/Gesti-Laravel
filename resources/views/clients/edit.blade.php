<!DOCTYPE html>
<html>

<head>
    <title>EDITAR CLIENT</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    h2{
        margin-left: 43%;
    }

    form{
        margin-left: 20%;
        margin-right: 20%;
    }

    .boto{
        margin-left: 93.5%;
        margin-top: 3%;
        margin-bottom: 3%;
    }

    .titol{
        margin-right: 5%;
    }


</style>

<body>

<!-- Mostrar mensaje de error general -->

@extends('adminlte::page')

@section('title', 'EDITAR CLIENT')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <!-- Header amb títol i botó -->
        <div class="titol">
            <h2>EDITAR CLIENT</h2>
        </div>

        <div class="boto">
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Tornar</a>
        </div>

        <div class="row">
            <!-- Columna Esquerra -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Dades Personals</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.update', $client) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nom">Nom:</label>
                                <input type="text" name="nom" class="form-control" value="{{ $client->nom }}" required>
                                @error('nom')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cognom">Cognom:</label>
                                <input type="text" name="cognom" class="form-control" value="{{ $client->cognom }}">
                                @error('cognom')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="correu">Correu:</label>
                                <input type="email" name="correu" class="form-control" value="{{ $client->correu }}" required>
                                @error('correu')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telefon">Telèfon:</label>
                                <input type="text" name="telefon" class="form-control" value="{{ $client->telefon }}" required>
                                @error('telefon')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    </div>
                </div>
            </div>

            <!-- Columna Dreta -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Dades de Contacte</h3>
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="nif">NIF:</label>
                                <input type="text" name="nif" class="form-control" value="{{ $client->nif }}" required>
                                @error('nif')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="adreça">Adreça:</label>
                                <input type="text" name="adreça" class="form-control" value="{{ $client->adreça }}" required>
                                @error('adreça')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="poblacio">Població:</label>
                                <input type="text" name="poblacio" class="form-control" value="{{ $client->poblacio }}" required>
                                @error('poblacio')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="codi_postal">Codi Postal:</label>
                                <input type="text" name="codi_postal" class="form-control" value="{{ $client->codi_postal }}" required>
                                @error('codi_postal')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Actualitzar</button>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .card {
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #f8f9fa;
        }
        .card-header h3 {
            margin-bottom: 0;
            font-size: 1.25rem;
        }
    </style>
@endsection

</body>

</html>
