<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all(); // Obtenim tots els clients
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */

    
    public function create()
{
    // Renderitza la vista parcial create_modal i retorna el HTML en format JSON
    $html = view('clients.create_modal')->render();
    return response()->json(['html' => $html]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'               => 'required|string|max:255',
            'cognoms'           => 'required|string|max:255',
            'empresa'           => 'nullable|string|max:255',
            'tipus_client'      => 'required|in:Empresa,Particular',
            'adreça'            => 'nullable|string|max:255',
            'telefon'           => 'nullable|string|max:255',
            'correu_electronic' => 'required|email|unique:clients,correu_electronic',
            'nif'               => 'nullable|string|max:255|unique:clients,nif',
        ]);
    
        Client::create($data);
    
        return redirect()->route('clients.index')->with('success', 'Client creat correctament.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        if(request()->ajax()){
            return response()->json($client);
        }
        return view('clients.show', compact('client'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */public function edit(Client $client)
{
    // Siempre retorna la vista parcial, incluso si no es una petición AJAX
    $html = view('clients.edit_modal', compact('client'))->render();
    return response()->json(['html' => $html]);
}

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'nom'               => 'required|string|max:255',
            'cognoms'           => 'required|string|max:255',
            'empresa'           => 'nullable|string|max:255',
            'tipus_client'      => 'required|in:Empresa,Particular',
            'adreça'            => 'nullable|string|max:255',
            'telefon'           => 'nullable|string|max:255',
            'correu_electronic' => 'required|email|unique:clients,correu_electronic,' . $client->id,
            'nif'               => 'nullable|string|max:255|unique:clients,nif,' . $client->id,
        ]);
    
        $client->update($data);
    
        return redirect()->route('clients.index')->with('success', 'Client actualitzat correctament.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client eliminat correctament.');
    }
}
