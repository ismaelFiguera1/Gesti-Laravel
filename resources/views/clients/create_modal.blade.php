<!-- resources/views/clients/create_modal.blade.php -->
<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nom:</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Cognoms:</label>
        <input type="text" name="cognoms" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Empresa:</label>
        <input type="text" name="empresa" class="form-control">
    </div>
    <div class="form-group">
        <label>Tipus Client:</label>
        <select name="tipus_client" class="form-control" required>
            <option value="Empresa">Empresa</option>
            <option value="Particular">Particular</option>
        </select>
    </div>
    <div class="form-group">
        <label>Adreça:</label>
        <input type="text" name="adreça" class="form-control">
    </div>
    <div class="form-group">
        <label>Telefon:</label>
        <input type="text" name="telefon" class="form-control">
    </div>
    <div class="form-group">
        <label>Correu Electrònic:</label>
        <input type="email" name="correu_electronic" class="form-control" required>
    </div>
    <div class="form-group">
        <label>NIF:</label>
        <input type="text" name="nif" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Crear Client</button>
</form>
