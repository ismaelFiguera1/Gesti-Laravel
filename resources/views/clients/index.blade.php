@extends('adminlte::page')

@section('title', 'Llistat de Clients')

@section('content_header')
    <h1>Llistat de Clients</h1>
@endsection

@section('content')
    <div class="container-fluid">
      <a href="{{ route('clients.buscar') }}" id="btnCarregaFormBuscar" class="btn btn-secondary">Buscar Clients</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Clients</h3>
                <div class="card-tools">
                    <!-- Afegir classe "add-client" al botó -->
                    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm add-client boto-Afegir">Afegir Client</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Cognoms</th>
                            <th>Tipus</th>
                            <th>Empresa</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->cognoms }}</td>
                                <td>{{ $client->tipus_client }}</td>
                                <td>{{ $client->empresa }}</td>
                                <td>
                                    <!-- Botó "Veure" amb classe 'view-client' -->
                                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm view-client botoVeurer">Veure</a>
                                    <!-- Botó "Editar" amb classe 'edit-client' -->
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm edit-client boto-Editar">Editar</a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Estàs segur?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
              {{ $clients->links('vendor1.pagination.custom') }}

            </div>
        </div>
    </div>

    <!-- Modal básico -->
    <div class="modal fade" id="buscarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Cabecera del modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Título del Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
            Aquí va el contenido del modal.
          </div>
        </div>
      </div>
    </div>


    <!-- Modal per mostrar els detalls del client -->
    <div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="clientModalLabel">Detalls del Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tancar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body contingut-veurer-client">
            <!-- La informació es carregarà aquí via AJAX -->
          </div>
        </div>
      </div>
    </div>

    <!-- Modal per editar el client -->
    <div class="modal fade" id="clientEditModal" tabindex="-1" role="dialog" aria-labelledby="clientEditModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="clientEditModalLabel">Editar Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tancar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body contingut-editar-client">
            
          </div>
        </div>
      </div>
    </div>

    <!-- Modal per afegir un nou client -->
    <div class="modal fade" id="clientAddModal" tabindex="-1" role="dialog" aria-labelledby="clientAddModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="clientAddModalLabel">Afegir Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tancar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body contingut-afegir-client">
            <!-- El formulari per afegir client es carregarà aquí via AJAX -->
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
<script src="javascript/clients.js"></script>
@endsection
