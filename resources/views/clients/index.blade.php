@extends('layouts.app')

@section('content')
    <h1>Clients</h1>
    <a href="{{ route('clients.create') }}">Afegir Client</a>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <table>
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
                        <a href="{{ route('clients.show', $client->id) }}">Veure</a>
                        <a href="{{ route('clients.edit', $client->id) }}">Editar</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
