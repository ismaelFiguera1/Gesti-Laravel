<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class UsuariController extends Controller
{
    public function index()
    {
        $usuaris = Usuari::all();
        return view('usuaris.create', compact('usuaris'));
    }

    public function create()
    {
        return view('usuaris.create');
    }

    public function store(Request $request)
    {
        $data_registre = Carbon::now('Europe/Madrid')->format('Y-m-d\TH:i:s.v');

        // Validació de les dades rebudes
        $request->validate([
            'usuari' => 'required|unique:usuaris', // Nom ha de ser únic
            'correu' => 'required|email|unique:usuaris', // Correu ha de ser únic i vàlid
            'rol' => 'required|in:admin,usuari', // Assegura que el rol és vàlid
            'password' => 'required|min:6|confirmed', // La contrasenya ha de ser mínima de 6 caràcters i ha de coincidir amb la confirmació
        ]);

        // Inserció directa en la base de dades
        DB::table('usuaris')->insert([
            'usuari' => $request->input('usuari'),
            'password' => bcrypt($request->input('password')),
            'correu' => $request->input('correu'),
            'rol' => $request->input('rol'),
            'created_at' => $data_registre
        ]);

        // Redirigim a la llista d'usuaris amb un missatge d'èxit
        return redirect()->route('usuaris.index');
    }

    public function edit(Usuari $usuari)
    {
        return view('usuaris.edit', compact('usuari'));
    }

    public function update(Request $request, Usuari $usuari)
    {
        // Validem les dades rebudes
        $request->validate([
            'usuari' => 'required|unique:usuaris,usuari,' . $usuari->id,
            'correu' => 'required|email|unique:usuaris,correu,' . $usuari->id,
            'rol' => 'required|in:admin,usuari',
            'password' => 'nullable|min:8',
            'password_actual' => 'required'
        ]);

        // Comprovem que la contrasenya de l'administrador autenticat és correcta
        if (!Hash::check($request->input('password_actual'), Auth::user()->password)) {
            return redirect()->back()->withErrors(['password_actual' => 'La contrasenya de l\'administrador no és correcta.']);
        }

        // Preparem les dades per actualitzar
        $data = [
            'usuari' => $request->input('usuari'),
            'correu' => $request->input('correu'),
            'rol' => $request->input('rol'),
        ];

        // Si es proporciona una nova contrasenya, l'encriptem i l'assignem
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Actualitzem l'usuari amb les noves dades
        $usuari->update($data);

        // Redirigim amb un missatge d'èxit
        return redirect()->route('usuaris.index')->with('success');
    }



    public function destroy(Usuari $usuari)
    {
        $usuari->delete();
        return redirect()->route('usuaris.index');
    }
}
