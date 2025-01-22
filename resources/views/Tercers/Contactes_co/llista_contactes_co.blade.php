@extends('adminlte::page')

@section('title', 'Contactes')

@section('content_header')
    <h1>Gestió de Contactes</h1>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css"/>
    <style>


</style>
    <link rel="stylesheet" href="{{asset('vendor/css/contactes.css')}}"
@endsection

@section('content')

    @if(session('Failed'))
        <script>
            alertify.error("{{ session('Failed') }}");
        </script>
    @endif

    @if(session('Correcte'))
        <script>
            alertify.success("{{ session('Correcte') }}");
        </script>
    @endif
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
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuaris as $contacte)
                <tr>
                    <td>{{$contacte->id}}</td>
                    <td>{{$contacte->username}}</td>
                    <td>{{$contacte->email}}</td>
                    <td style="display:flex; ">

                            <form action="{{ route('contacte.esborrar',$contacte->id) }}" method="post" id="form-{{$contacte->id}}">
                                @csrf
                                @method('post')
                                <button  id="btn-esborrar" type="button" class=" btn-outline-danger border-0" onclick="esborraContacte({{$contacte->id}})"><i class="fas fa-trash"></i></button>
                            </form>
                            <button class="btn-outline-secondary border-0" style="margin-left: 4%;" data-toggle="modal" data-target="#userFormModal"><i class="fas fa-edit"></i></button>
                            @include('tercers/Contactes_co/layouts/form-actualitzar')
                    </td>

                </tr>
 @endforeach


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

    $('#taulacontactes').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/ca.json'
        },
        "order": [[0, "asc"]],
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tots"]]
    });




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
        @if ($errors->any() && isset($editar) && $editar)
        $('#editarFormModal').fadeIn();
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
    function esborraContacte(id){
        alertify.confirm("ELIMINAR MONITOR","Estàs segur que vols eliminar aquest monitor? Aquesta acció no es pot desfer.",
            function(){
                alertify.success('CONTACTE ELIMINAT',document.getElementById(`form-${id}`).submit());
            },
            function(){
                alertify.error('CANCELAT');
            });
    }

</script>
@endsection
