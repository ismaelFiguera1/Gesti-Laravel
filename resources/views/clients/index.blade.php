<!DOCTYPE html>
<html>

<head>
    <title>CLIENTS</title>

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

    .client-link {
        padding: 3px 5px;
        border-radius: 4px;
    }

    .client-link:hover {
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

    .btn-danger.btn-sm {
        background-color: transparent !important;
        color: #dc3545 !important;
        border: none !important;
        transition: all 0.3s ease;
    }

    .btn-danger.btn-sm:hover {
        background-color: #dc3545 !important;
        color: white !important;
    }
</style>

<body>

<!-- Mostrar mensaje de error general -->

@extends('adminlte::page')

@section('title', 'GESTIÓ DE CLIENTS')

@section('content')

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<div class = "card">

    <div class="card-header">
        <h2 class="mt-2">GESTIÓ DE CLIENTS</h2>
    </div>

    <div class="card-body">
        <div class="header">

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#clientFormModal"><i class="fa-duotone fa-solid fa-plus"></i> Afegir Nou Client</button>
            </div>
        </div>

    <!-- Modal per crear un nou client -->
    <div class="modal fade" id="clientFormModal" tabindex="-1" aria-labelledby="clientFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientFormModalLabel">Afegir Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tancar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom:</label>
                            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}"
                                   placeholder="Introdueix el nom" required>
                            @error('nom')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cognom">Cognom:</label>
                            <input type="text" name="cognom" class="form-control" value="{{ old('cognom') }}"
                                   placeholder="Introdueix el cognom">
                            @error('cognom')
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
                            <label for="telefon">Telèfon:</label>
                            <input type="text" name="telefon" class="form-control" value="{{ old('telefon') }}"
                                   placeholder="Introdueix el telèfon" required>
                            @error('telefon')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nif">NIF:</label>
                            <input type="text" name="nif" class="form-control" value="{{ old('nif') }}"
                                   placeholder="Introdueix el NIF" required>
                            @error('nif')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="adreça">Adreça:</label>
                            <input type="text" name="adreça" class="form-control" value="{{ old('adreça') }}"
                                   placeholder="Introdueix l'adreça" required>
                            @error('adreça')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="poblacio">Població:</label>
                            <input type="text" name="poblacio" class="form-control" value="{{ old('poblacio') }}"
                                   placeholder="Introdueix la població" required>
                            @error('poblacio')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="codi_postal">Codi Postal:</label>
                            <input type="text" name="codi_postal" class="form-control" value="{{ old('codi_postal') }}"
                                   placeholder="Introdueix el codi postal" required>
                            @error('codi_postal')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
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

    <!-- Llistat de clients -->
    <h3>Llistat de Clients</h3>
    <table id="taulaClients" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Cognom</th>
            <th>Correu</th>
            <th>Telèfon</th>
            <th>NIF</th>
            <th>Accions</th>
        </tr>
        </thead>
        <tbody>
        @if ($clients->isEmpty())
            <tr>
                <td colspan="8" class="text-center">No hi ha clients registrats.</td>
            </tr>
        @else
            @foreach ($clients as $client)
                <tr>
                    <td>
                        <a href="{{ route('clients.edit', $client) }}"
                           class="text-dark client-link"
                           style="text-decoration: none; cursor: pointer;">
                            {{ $client->nom }}
                        </a>
                    </td>
                    <td>{{ $client->cognom }}</td>
                    <td>{{ $client->correu }}</td>
                    <td>{{ $client->telefon }}</td>
                    <td>{{ $client->nif }}</td>
                    <td>
                        <div class="action-buttons">
                            <form action="{{ route('clients.destroy',$client->id) }}" method="POST" id="form-{{$client->id}}"
                                style="display:inline;">
                              @csrf
                              @method('POST')
                              <button type="button" class="btn btn-danger btn-sm" onclick="esborrarClient({{$client->id}})">
                                <i class="fa-solid fa-trash"></i>
                              </button>
                          </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection

</div>

@section('js')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#taulaClients').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/ca.json',
                    lengthMenu: "Mostrar _MENU_ registres per pàgina",
                    zeroRecords: "No s'han trobat registres",
                    info: "Mostrant _START_ a _END_ de _TOTAL_ registres",
                    infoEmpty: "Mostrant 0 a 0 de 0 registres",
                    infoFiltered: "(filtrat de _MAX_ registres totals)",
                    search: "Cercar:",
                    paginate: {
                        first: "Primer",
                        previous: "Anterior",
                        next: "Següent",
                        last: "Últim"
                    }
                },
                "order": [[0, "asc"]],
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tots"]]
            });
        });
    </script>
@endsection

<script>
    function esborrarClient(id){
        alertify.confirm("ELIMINAR CLIENT","Estàs segur que vols eliminar aquest client? Aquesta acció no es pot desfer.",
            function(){
                alertify.success('CLIENT ELIMINAT',document.getElementById(`form-${id}`).submit());
            },
            function(){
                alertify.error('CANCELAT');
            });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>
