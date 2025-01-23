<!DOCTYPE html>
<html>

<head>
    <title>GESTIÓ D'USUARIS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css"/>
</head>

<style>
    .header{
        margin-top: 2%;
        margin-bottom: 1%;
        display: flex;
        justify-content: flex-end;
    }

    .input-group{

        margin-bottom: 1%;
    }

    .d-flex{
        margin-left: 0;
    }

    .usuari-link {
        padding: 3px 5px;
        border-radius: 4px;
    }

    .usuari-link:hover {
        background-color: #f0f0f0;
        color: #0d6efd !important;
        text-decoration: underline !important;
        font-weight: 500;
    }

    .btn-primary {
        color: #6c757d !important;
        background: #ffffff !important;
        border: 1px solid #6c757d !important;
        font-weight: normal;
        padding: 6px 12px;
        border-radius: 4px;
        transition: all 0.2s ease;
        margin-right: 15px;
        margin-top: -20px;
    }

    .btn-primary:hover {
        color: #495057 !important;
        background: #e9ecef !important;
        border-color: #495057 !important;
    }

    .btn-primary:active {
        background: #dee2e6 !important;
        border-color: #495057 !important;
    }

    .btn-primary i {
        margin-right: 5px;
    }
</style>

<body>

<!-- Mostrar mensaje de error general -->

@extends('adminlte::page')

@section('title', 'GESTIÓ USUARIS')

@section('content')

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
    <h2 class="mt-2">GESTIÓ D'USUARIS</h2>
        </div>
        <div class="card-body">
    <div class="header">

            <!-- Botó per obrir el formulari en un modal, situat a dalt a la dreta -->
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userFormModal"><i class="fa-duotone fa-solid fa-plus"></i> Afegir Nou Usuari</button>
            </div>
    </div>

    <!-- Modal per crear un nou usuari -->
    <div class="modal fade" id="userFormModal" tabindex="-1" aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userFormModalLabel">Afegir Usuari</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tancar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuaris.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="usuari">Nom:</label>
                            <input type="text" name="usuari" class="form-control" value="{{ old('usuari') }}"
                                   placeholder="Introdueix el nom d'usuari" required>
                            @error('usuari')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="correu">Correu:</label>
                            <input type="email" name="correu" class="form-control" value="{{ old('correu') }}"
                                   placeholder="Introdueix el correu electrònic" required>
                            @error('correu')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select name="rol" class="form-control" required>
                                <option value="" disabled selected>Selecciona un rol</option>
                                <option value="admin">Administrador</option>
                                <option value="usuari">Usuari</option>
                            </select>
                            @error('rol')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Contrasenya:</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Introdueix la contrasenya" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contrasenya:</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirma la contrasenya" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 5px">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Missatge d'èxit -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Missatges d'error de validació -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Llistat d'usuaris -->
    <h3>Llistat d'Usuaris</h3>
    <table class="table table-bordered table-striped" id="taulaUsuaris">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Correu</th>
            <th>Rol</th>
            <th>Accions</th>
        </tr>
        </thead>
        <tbody>
        @if ($usuaris->isEmpty())
            <tr>
                <td colspan="4" class="text-center">No hi ha usuaris registrats.</td>
            </tr>
        @else
            @foreach ($usuaris as $usuari)
                <tr>
                    <td>{{ $usuari->usuari }}</td>
                    <td>{{ $usuari->correu }}</td>
                    <td>{{ $usuari->rol }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('usuaris.edit', $usuari) }}"
                               class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('usuaris.destroy',$usuari->id) }}" method="POST" id="form-{{$usuari->id}}"
                                  style="margin-left: 5%; display:inline;">
                                @csrf
                                @method('POST')
                                <button type="button" class="btn btn-danger btn-sm" onclick="esborrarUsuari({{$usuari->id}})">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
        </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#taulaUsuaris').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/ca.json'
                },
                "order": [[0, "asc"]],
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tots"]]
            });
        });
    </script>
@endsection

<script>
function esborrarUsuari(id){
    alertify.confirm("ELIMINAR USUARI","Estàs segur que vols eliminar aquest usuari? Aquesta acció no es pot desfer.",
        function(){
            alertify.success('USUARI ELIMINAT',document.getElementById(`form-${id}`).submit());
        },
        function(){
            alertify.error('CANCELAT');
        });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>
