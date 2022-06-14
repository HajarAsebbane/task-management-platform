<?php

namespace App\Http\Controllers;

use App\Models\tache;
use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class BU_ControllerTache extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectList=DB::select('SELECT projects.id, projects.name, projects.datedebut, projects.datefin, projects.description,users.name as nameuser FROM users,projects WHERE users.id=projects.user_id and projects.user_id = ?',[Auth::id()]);
        return view('tache.BUindex',compact('projectList'));
    }

    public function valider($id)
    {
       $tache=tache::find($id);
       $tache->etat_tache=1;
       $tache->save();
       return redirect()->route('BU_TacheValider')->with([
        'success'=>'Projet validé avec succès'
    ]);;
    }

    public function TacheValider()
    {
        $TacheValider=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,taches.etat_tache,users.name as employe,projects.name as project ,taches.etat_tache FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id  and  taches.etat_tache=1 and users.Encadrant_BU=?',[Auth::id()]);
        return view('tache.BU_TacheValider',compact('TacheValider'));
    }

    public function TacheEnCours()
    {
        $TacheEnCours=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,taches.etat_tache,users.name as employe,projects.name as project ,taches.etat_tache FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id and taches.etat_tache=0 and users.Encadrant_BU=?',[Auth::id()]);
        return view('tache.BU_TacheEnCours',compact('TacheEnCours'));
    }

    /*public function TacheNull(){
        $tacheNull=DB::select('SELECT taches.id,taches.name,taches.datedebut,taches.datefin,taches.description,taches.etat_tache,projects.name as project  FROM taches,projects,users WHERE taches.user_id is null and taches.project_id=projects.id and taches.user_id=users.id and users.Encadrant_BU=?',[Auth::id()]);
        return view('tache.BU_TacheNull',compact('tacheNull'));
    }*/

    public function TacheNull(){
        $tacheNull=DB::select('SELECT taches.id,taches.name,taches.datedebut,taches.datefin,taches.description,taches.etat_tache,projects.name as project  FROM taches,projects WHERE taches.user_id is null and taches.project_id=projects.id');
        return view('tache.BU_TacheNull',compact('tacheNull'));
    }

    public function SelectUser($id){
        $user=DB::select('SELECT `id`, `name`, `Prenom`,`Téléphone`,`Adresse`, `user_type`, `email`,`Encadrant_BU` FROM `users` WHERE Encadrant_BU= :id',['id'=>Auth::id()]);
        session(['idTacheNull_session' => $id]);
        return view('tache.BU_TacheAffecte',compact('user'));
    }
    public function AffecterTache(Request $request){
          $idTacheNull=session()->get('idTacheNull_session');
          $tache=tache::find($idTacheNull);
          $tache->update([
              'user_id'=>$request->user_id 
          ]); 
          return redirect()->route('BU_TacheEnCours')->with([
              'success'=>'Tache Affecter avec succès'
          ]);
    } 



    public function Periode($id){
         session(['iduser_session' => $id]);
         return view('User.BU_periode');
       }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tache.BUcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'datedebut'=>'required',
            'datefin'=>'required'

        ]);

        $tache =tache::create($request->all());
        return redirect()->route('BU_TacheEnCours')->with('success','tache ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project=project::find($id);
        $userBU=User::where('Encadrant_BU',$project->user_id)->get();
        return view('tache.BUcreate',compact('project','userBU'));
    }
   
    public function detailsTache($id){
        $tachepro=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,users.name as employe,taches.etat_tache FROM taches,users WHERE taches.user_id=users.id and taches.project_id = ?', [$id]);
        return view('tache.BUshow',compact('tachepro'));
    }

    public function tacheaujourd(){    
        $tachepro=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name,taches.etat_tache, taches.description,users.name as employe,projects.name as nameproject FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id  and taches.datefin=CURDATE() and taches.etat_tache=1 and users.Encadrant_BU=?',[Auth::id()]);
        return view('BU.dashboardBU',compact('tachepro'));
    }

    public function Rapport_Par_Jours(Request $request){
        $tacheUser=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name,taches.etat_tache, taches.description,users.name as employe,projects.name as project FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id  and taches.datefin=CURDATE() and taches.etat_tache=1 and users.Encadrant_BU=?',[Auth::id()]);
        view()->share('tacheUser',$tacheUser);
        $pdf=PDF::loadView('User.pdf',$tacheUser);
        return $pdf->download('document' . '.pdf');
              
     }  
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tache=DB::select('SELECT taches.id,taches.project_id,taches.datedebut, taches.datefin, taches.name, taches.description,taches.user_id as employe,users.name as nameEm,Encadrant_BU FROM taches,users WHERE taches.user_id=users.id and taches.id = ?', [$id]);     
        foreach($tache as $item){
        $user=User::where('Encadrant_BU',$item->Encadrant_BU)->get();
        }
        return view('tache.BUedit',compact('tache','user'));
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

        $tache=tache::find($id);
        $tache->update($request->all());
        return redirect()->route('BU_project.index')->with([
            'success'=>'Tache modifier avec succès'
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
        tache::destroy($id);
        return redirect()->back();
    }
}
