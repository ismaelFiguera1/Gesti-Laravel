<?php

namespace App\Http\Controllers\Companies;
use Illuminate\Http\Request;




use App\Models\User;

class ContactesController
{

    public function VistaContactes()
    {
        $usuaris = User::all();

            return view('Tercers.Contactes_co.llista_contactes_co',compact('usuaris'));

    }
    public function afegirContacte(Request $request)
    {
        $validates = $request->validate([
            'nomcomplet' => 'required|string|max:100',
            'email' => 'required|email',
            'usuari' => 'required|string|min:5|max:100',
            'telefon' => 'nullable|string|min:5|max:20',
            'contrasenya_confirmation' => 'required|string|min:6|max:100',
            'contrasenya' => 'required|string|min:6|max:100|same:contrasenya_confirmation',
        ], [
            'nomcomplet.required' => 'El nom és obligatori.',
            'nomcomplet.max' => 'El nom no pot superar els 100 caràcters.',
            'email.required' => 'El correu és obligatori.',
            'email.email' => 'El correu no té el format adequat.',
            'usuari.required' => "L'usuari és obligatori.",
            'usuari.min' => "L'usuari ha de tenir més de 5 caràcters.",
            'usuari.max' => "L'usuari no pot tenir més de 100 caràcters.",
            'telefon.min' => 'El telèfon ha de tenir més de 5 caràcters.',
            'telefon.max' => 'El telèfon no pot tenir més de 20 caràcters.',
            'contrasenya.required' => 'La contrasenya és obligatòria.',
            'contrasenya.min' => 'La contrasenya ha de tenir més de 6 caràcters.',
            'contrasenya.max' => 'La contrasenya no pot tenir més de 100 caràcters.',
            'contrasenya.same' => 'Les contrasenyes no coincideixen.',
        ]);
        $user = User::create([
            'email' => $validates['email'],
            'username' => $validates['usuari'],
            'password' => bcrypt($validates['contrasenya']),
        ]);

        return redirect()->back()->with('afegit', true);
    }

    public function esborrarContacte($id)
    {
        $usuari = User::where('id',$id);
        if($usuari){
            $usuari->delete();
            return redirect()->back()->with('Correcte', 'Contacte eliminat correctament!');
        }else{
            return redirect()->back()->with('Failed', 'El contacte no existeix.');
        }
    }

    public function actualitzarContacte($id,Request $request)
    {
        $validates = $request->validate([
            'email' => 'required|email',
            'usuari' => 'required|string|min:5|max:100',
        ], [
            'email.required' => 'El correu és obligatori.',
            'email.email' => 'El correu no té el format adequat.',
            'usuari.required' => "L'usuari és obligatori.",
            'usuari.min' => "L'usuari ha de tenir més de 5 caràcters.",
            'usuari.max' => "L'usuari no pot tenir més de 100 caràcters.",
        ]);
        $usuari = User::where('id',$id)->update([
                'email' => $validates['email'],
                'username' => $validates['usuari'],
        ]);

            return redirect()->back()->with('editar', true);

    }
}
