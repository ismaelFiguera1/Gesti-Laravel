<!-- resources/views/clients/edit_modal.blade.php -->
<form action="{{ route('clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nom:</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom', $client->nom) }}" required>
    </div>
    <div class="form-group">
        <label>Cognoms:</label>
        <input type="text" name="cognoms" class="form-control" value="{{ old('cognoms', $client->cognoms) }}" required>
    </div>
    <div class="form-group">
        <label>Empresa:</label>
        <input type="text" name="empresa" class="form-control" value="{{ old('empresa', $client->empresa) }}">
    </div>
    <div class="form-group">
        <label>Tipus Client:</label>
        <select name="tipus_client" class="form-control" required>
            <option value="Empresa" {{ $client->tipus_client == 'Empresa' ? 'selected' : '' }}>Empresa</option>
            <option value="Particular" {{ $client->tipus_client == 'Particular' ? 'selected' : '' }}>Particular</option>
        </select>
    </div>
    <div class="form-group">
        <label>Adreça:</label>
        <input type="text" name="adreça" class="form-control" value="{{ old('adreça', $client->adreça) }}">
    </div>
    <div class="form-group">
        <label>Telefon:</label>
        <input type="text" name="telefon" class="form-control" value="{{ old('telefon', $client->telefon) }}">
    </div>
    <div class="form-group">
        <label>Correu Electrònic:</label>
        <input type="email" name="correu_electronic" class="form-control" value="{{ old('correu_electronic', $client->correu_electronic) }}" required>
    </div>
    <div class="form-group">
        <label>NIF:</label>
        <input type="text" name="nif" class="form-control" value="{{ old('nif', $client->nif) }}">
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Client</button>
</form>
