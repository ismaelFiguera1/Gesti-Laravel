<?php

namespace App\Http\Controllers\Companies;
use Illuminate\Http\Request;




use App\Models\User;
use Illuminate\Support\Facades\DB;

class ContactesController
{

    public function VistaContactes()
    {
        $usuaris = User::join('account_details', 'users.id', '=', 'account_details.user_id')
            ->where('account_details.company', 1)
            ->select('users.*', 'account_details.*')
            ->get();

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
            'password' => $validates['contrasenya'],

        ]);
        $dadesadicionals = DB::table('account_details')->insert([
            'user_id' =>$user->id,
            'nomcomplet' => $validates['usuari'],
            'telefon'=>$validates['telefon'],
            'company' => 1,
        ]);


        return redirect()->back()->with('success', 'contacte afegit correctament');
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
            'correu' => 'required|email',
            'nomusuari' => 'required|string|min:5|max:100',
            'telefonmovil'=>'nullable|string|min:9|max:20',
            'nomcomplet'=>'required|string|min:5|max:100',
        ], [
            'correu.required' => 'El correu és obligatori.',
            'correu.email' => 'El correu no té el format adequat.',
            'nomusuari.required' => "L'usuari és obligatori.",
            'nomusuari.min' => "L'usuari ha de tenir més de 5 caràcters.",
            'nomusuari.max' => "L'usuari no pot tenir més de 100 caràcters.",
            'nomcomplet.required'=> "Nom Complet és Obligatori",
        ]);
        //cambiar dades de l'usuari
        $usuari = User::where('id',$id)->update([
                'email' => $validates['correu'],
                'username' => $validates['nomusuari'],

        ]);
        //cambiar les dades addicionals telfon i nom complet de contacte
        $dades_adicionals = DB::table('account_details')->update([
             'telefon'=>$validates['telefonmovil'],
            'nomcomplet'=>$validates['nomcomplet'],
        ]);


            return redirect()->back()->with('success', 'Usuari Actualitzat Perfectament');

    }
    /*per vincular el contacte com a  primary*/
    public function VincularContacte($id)
    {
        $usuari = DB::table('compsa_clients')->update(['primary_contact'=>$id]);
        redirect()->back()->with('success', 'Contacte Vinculat correctament');
    }
}
