<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('nom')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'nullable|string|max:255',
            'correu' => 'required|email|unique:clients,correu',
            'telefon' => 'required|string|max:20',
            'adreça' => 'required|string|max:255',
            'poblacio' => 'required|string|max:255',
            'codi_postal' => 'required|string|max:10',
        ]);

        Client::create($validated);
        return redirect()->route('clients.index')->with('success');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'nullable|string|max:255',
            'correu' => 'required|email|unique:clients,correu,' . $client->id,
            'telefon' => 'required|string|max:20',
            'adreça' => 'required|string|max:255',
            'poblacio' => 'required|string|max:255',
            'codi_postal' => 'required|string|max:10',
        ]);

        $client->update($validated);
        return redirect()->route('clients.index')->with('success');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }
}
