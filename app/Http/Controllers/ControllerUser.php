<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class ControllerUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        return view('User.index',compact('user'));

    }

    public function Rapport()
    {
        $user=User::all();
        return view('User.Rapport',compact('user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$user=User::all();
        $userBU=DB::select('SELECT id,name FROM users WHERE user_type=2');
        return view('User.create',compact('userBU'));
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
        return redirect()->route('user.index')->with([
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
        $tacheUser=DB::select('SELECT taches.id,taches.name,taches.datedebut,taches.datefin,taches.description,projects.name as project,taches.etat_tache from users,taches,projects where users.id=taches.user_id and taches.project_id=projects.id and  users.id=? ', [$id]);
        return view('User.show',compact('tacheUser'));
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
        return view('User.edit',compact('user'));
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
        return redirect()->route('user.index')->with([
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
        $user= User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success','Utilisateur supprimer avec succès');
    }
}
