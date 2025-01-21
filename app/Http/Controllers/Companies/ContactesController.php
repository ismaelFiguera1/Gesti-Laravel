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
        $validates=$request->validate([
            'nomcomplet' => 'required|string|max:100',
            'email' => 'required|email',
        ],[
            'nomcomplet.required' => 'El Nom és obligatori',
            'nomcomplet.max' =>'El nom no és pot supero els 100 caracteres',
            'email.required' => 'el Correu és Obligatori',
            'email.email'=>'el Correu no té el format adequada'
        ]);


        return redirect()->route('contactes.afegir')->withErrors($validates)->withInput();

    }
}
