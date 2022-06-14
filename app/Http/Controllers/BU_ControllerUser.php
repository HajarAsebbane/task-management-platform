<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BU_ControllerUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=DB::select('SELECT `id`, `name`, `Prenom`,`Téléphone`,`Adresse`, `user_type`, `email`,`Encadrant_BU` FROM `users` WHERE Encadrant_BU= :id',['id'=>Auth::id()]);
       
        // $user=User::where('Encadrant_BU','=',auth()->user()->id);
        return view('User.BUindex',compact('user'));
    }

    public function Rapport()
    {
        $user=DB::select('SELECT `id`, `name`, `Prenom`,`Téléphone`,`Adresse`, `user_type`, `email`,`Encadrant_BU` FROM `users` WHERE Encadrant_BU= :id',['id'=>Auth::id()]);

        return view('User.BU_Rapport',compact('user'));

    }

   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userBU=DB::select('SELECT id,name FROM users WHERE user_type=2');

        return view('User.BUcreate',compact('userBU'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->Prenom = $request->Prenom;
        $user->Adresse = $request->Adresse;
        $user->Téléphone = $request->Téléphone;

        $user->save();
        return redirect()->route('BU_user.index')->with([
            'success'=>'Utilisateur ajouté avec succès'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tacheUser=DB::select('SELECT taches.id,taches.name,taches.datedebut,taches.datefin,taches.description,taches.etat_tache from users,taches where users.id=taches.user_id and users.id=? ', [$id]);
        return view('User.BUshow',compact('tacheUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        return view('User.BUedit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->update($request->all());
        return redirect()->route('BU_user.index')->with([
            'success'=>'Utilisateur modifier avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
