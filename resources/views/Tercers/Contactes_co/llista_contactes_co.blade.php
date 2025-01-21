@extends('adminlte::page')

@section('title', 'Contactes')

@section('content_header')
    <h1>Gestió de Contactes</h1>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <style>


</style>
    <link rel="stylesheet" href="{{asset('vendor/css/contactes.css')}}"
@endsection

@section('content')


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contactes</h3>
            <button class="btn btn-outline-dark float-right" id="afegir-contacte-btn"> <i class="fas fa-plus"></i> Afegir Contacte</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="taulacontactes" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuaris as $contacte)
                <tr>
                    <td>{{$contacte->id}}</td>
                    <td>{{$contacte->username}}</td>
                    <td>{{$contacte->email}}</td>


                </tr>
 @endforeach
                <tr>
                    <td>1</td>
                    <td>Juan Pérez</td>
                    <td>juan@example.com</td>


                </tr>

                </tbody>
            </table>

        </div>
        @include('tercers/Contactes_co/layouts/form-afegir')

        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection

@section('js')


    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>

    $('#taulacontactes').DataTable();
    /**control form overlay**/
    $(document).ready(function () {

        $('#afegir-contacte-btn').click(function () {
            $('#overlay-form').fadeIn(); // Muestra el overlay
        });


        $('#close-form-btn, #close-form-btn-2').click(function () {
            $('#overlay-form').fadeOut(); // Esconde el overlay
        });


        $('#overlay-form').click(function (e) {
            if ($(e.target).is('#overlay-form')) {
                $('#overlay-form').fadeOut();
            }
        });
        @if ($errors->any())
        $('#overlay-form').fadeIn(); // Muestra el formulario cuando hay errores
        @endif
    });

    /**validacion de les contrasenyes desde el client **/
    $(document).ready(function () {
        $('#btn-afegir').click(function () {
            // Obtener los valores de los campos de contraseña
            const contrasenya1 = $('#contrasenya1').val();
            const contrasenya2 = $('#contrasenya2').val();

            // Limpiar mensajes previos
            $('.error-message').remove();

            // Validar si las contraseñas coinciden
            if (contrasenya1 === '' || contrasenya2 === '') {
                $('<p class="error-message" style="color: red;">Els camps de contrasenya no poden estar buits.</p>')
                    .insertAfter('#contrasenya2');
            } else if (contrasenya1 !== contrasenya2) {
                $('<p class="error-message" style="color: red;">Les contrasenyes no coincideixen.</p>')
                    .insertAfter('#contrasenya2');
            } else {
                 $('#form-afegir').submit();
            }
        });
    });

</script>
@endsection
