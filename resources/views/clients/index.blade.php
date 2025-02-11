@extends('adminlte::page')

@section('title', 'Llistat de Clients')

@section('content_header')
    <h1>Llistat de Clients</h1>
@endsection

@section('content')
    <div class="container-fluid">
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
                    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm add-client">Afegir Client</a>
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
                                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm view-client">Veure</a>
                                    <!-- Botó "Editar" amb classe 'edit-client' -->
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm edit-client">Editar</a>
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
          <div class="modal-body">
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
          <div class="modal-body">
            <!-- El formulari d'edició es carregarà aquí via AJAX -->
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
          <div class="modal-body">
            <!-- El formulari per afegir client es carregarà aquí via AJAX -->
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        // Funcionalitat per "Veure"
        $(document).on('click', '.view-client', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    var content = '<p><strong>Nom:</strong> ' + data.nom + '</p>';
                    content += '<p><strong>Cognoms:</strong> ' + data.cognoms + '</p>';
                    content += '<p><strong>Empresa:</strong> ' + (data.empresa ? data.empresa : '-') + '</p>';
                    content += '<p><strong>Tipus Client:</strong> ' + data.tipus_client + '</p>';
                    content += '<p><strong>Adreça:</strong> ' + (data.adreça ? data.adreça : '-') + '</p>';
                    content += '<p><strong>Telefon:</strong> ' + (data.telefon ? data.telefon : '-') + '</p>';
                    content += '<p><strong>Correu Electrònic:</strong> ' + data.correu_electronic + '</p>';
                    content += '<p><strong>NIF:</strong> ' + (data.nif ? data.nif : '-') + '</p>';
                    $('#clientModal .modal-body').html(content);
                    $('#clientModal').modal('show');
                },
                error: function(){
                    alert('Error carregant els detalls del client.');
                }
            });
        });

        // Funcionalitat per "Editar"
        $(document).on('click', '.edit-client', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $('#clientEditModal .modal-body').html(response.html);
                    $('#clientEditModal').modal('show');
                },
                error: function(){
                    alert('Error carregant el formulari d\'edició.');
                }
            });
            console.log("Clic editar capturat");
        });

        // Funcionalitat per "Afegir Client"
        $(document).on('click', '.add-client', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $('#clientAddModal .modal-body').html(response.html);
                    $('#clientAddModal').modal('show');
                },
                error: function(){
                    alert('Error carregant el formulari per afegir client.');
                }
            });
            console.log("Clic afegir capturat");
        });
    });
</script>
@endsection
