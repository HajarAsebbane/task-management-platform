<?php

namespace App\Http\Controllers;
use App\Models\tache;
use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use PDF;
use App\Notifications\TacheNotification;

class ControllerTache extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectList=DB::select('SELECT projects.id, projects.name, projects.datedebut, projects.datefin, projects.description,users.name as nameuser FROM users,projects WHERE users.id=projects.user_id');
        return view('tache.index',compact('projectList'));
    }

    public function valider($id)
    {
       $tache=tache::find($id);
       $tache->etat_tache=1;
       $tache->save();
       return redirect()->route('TacheValider')->with([
        'success'=>'Projet validé avec succès'
    ]);;
    }

    public function TacheValider()
    {
        $TacheValider=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,taches.etat_tache,users.name as employe,projects.name as project ,taches.etat_tache FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id and taches.etat_tache=1');
        return view('tache.TacheValider',compact('TacheValider'));
    }

    public function TacheEnCours()
    {
        $TacheEnCours=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,taches.etat_tache,users.name as employe,projects.name as project ,taches.etat_tache FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id and taches.etat_tache=0');
        return view('tache.TacheEnCours',compact('TacheEnCours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tache.create'); 
    }

     public function show($id)
    {
     $project=project::find($id);
    // $userBU=User::where('Encadrant_BU',$project->user_id)->get();
    $userBU=DB::select('SELECT id,name FROM users WHERE user_type=0');
     return view('tache.create',compact('project','userBU'));
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


        $user = User::all();
        $tache =tache::create($request->all());
        Notification::send($user, new TacheNotification($request->name));
        //$tache->notify(new TacheNotification($tache));
       return redirect()->route('tache.index')->with('success','tache ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function detailsTache($id){
        $tachepro=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,users.name as employe,taches.etat_tache FROM taches,users WHERE taches.user_id=users.id and taches.project_id = ?', [$id]);
        return view('tache.show',compact('tachepro'));
    }
    
     public function tacheaujourd(){    
        $tachepro=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name,taches.etat_tache, taches.description,users.name as employe,projects.name as nameproject FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id  and taches.datefin=CURDATE() and taches.etat_tache=1');
        return view('Respo.dashboard',compact('tachepro'));
    }

    public function TacheNull(){
        $tacheNull=DB::select('SELECT taches.id,taches.name,taches.datedebut,taches.datefin,taches.description,taches.etat_tache,projects.name as project  FROM taches,projects WHERE taches.user_id is null and taches.project_id=projects.id');
        return view('tache.TacheNull',compact('tacheNull'));
    }
    public function SelectUser($id){
      $user=DB::select('SELECT * FROM users WHERE user_type=0');
     // $user=User::all();
      session(['idTacheNull_session' => $id]);
      return view('tache.TacheAffecte',compact('user'));
    }
    public function AffecterTache(Request $request){
        $idTacheNull=session()->get('idTacheNull_session');
        $tache=tache::find($idTacheNull);
        $tache->update([
            'user_id'=>$request->user_id 
        ]); 
        return redirect()->route('TacheEnCours')->with([
            'success'=>'Tache Affecter avec succès'
        ]);
      } 
      
      public function Periode($id){
        session(['iduser_session' => $id]);
         return view('User.periode');
       }

     public function pdf(Request $request){
        $iduser=session()->get('iduser_session');
         $tacheUser=DB::select('SELECT taches.name ,taches.datedebut,taches.datefin,taches.description,taches.etat_tache,projects.name as project FROM taches,projects WHERE taches.project_id=projects.id and taches.user_id=:iduser and  taches.datedebut BETWEEN :datedebut and :datefin ',['datedebut' => $request->datedebut ,'datefin' => $request->datefin,'iduser'=>$iduser] );
          //return view('User.show',compact('tacheUser'));
          view()->share('tacheUser',$tacheUser);
          $pdf=PDF::loadView('User.pdf',$tacheUser);
          return $pdf->download('document' . '.pdf');
          
        }
    public function Rapport_Par_Jours(Request $request){
        $tacheUser=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name,taches.etat_tache, taches.description,users.name as employe,projects.name as project FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id  and taches.datefin=CURDATE() and taches.etat_tache=1');
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
        return view('tache.edit',compact('tache','user'));
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
        return redirect()->route('showtache', ['id' => $id])->with([
            'success'=>'Tache modifier avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id//
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tache::destroy($id);
        return redirect()->back();
    }
}
