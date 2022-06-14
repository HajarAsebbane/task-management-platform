<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tache;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class User_ControllerTache extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::find(auth()->user()->id);
        $projectList=DB::select('SELECT taches.name , taches.id,taches.datedebut,taches.datefin,taches.description,taches.etat_tache, users.name  as username from taches,users where taches.user_id=users.id and users.id = :id',['id'=>Auth::id()]);
        return view('tache.UserIndex',compact('projectList','user'));
    }

    public function valider($id)
    {
       $tache=tache::find($id);
       $tache->etat_tache=1;
       $tache->save();
       return redirect()->route('User_TacheValider')->with([
        'success'=>'Projet validé avec succès'
    ]);;
    }

    public function TacheValider()
    {
        $user=User::find(auth()->user()->id);
        $TacheValider=DB::select('SELECT taches.name , taches.id,taches.datedebut,taches.datefin,taches.description,taches.etat_tache, users.name  as username from taches,users where taches.user_id=users.id  and taches.etat_tache=1 and users.id = :id',['id'=>Auth::id()]);
        return view('tache.User_TacheValider',compact('TacheValider','user'));
    }

    public function TacheEnCours()
    {
        $user=User::find(auth()->user()->id);
       // $TacheEnCours=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,taches.etat_tache,users.name as employe,projects.name as project ,taches.etat_tache FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id and taches.etat_tache=0');
        $TacheEnCours=DB::select('SELECT taches.name , taches.id,taches.datedebut,taches.datefin,taches.description,taches.etat_tache, users.name  as username from taches,users where taches.user_id=users.id  and taches.etat_tache=0 and users.id = :id',['id'=>Auth::id()]);
        return view('tache.User_TacheEnCours',compact('TacheEnCours','user'));
    }

    public function detailsTache($id){
        $user=User::find(auth()->user()->id);
        $tachepro=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name, taches.description,users.name as employe,taches.etat_tache FROM taches,users WHERE taches.user_id=users.id and taches.project_id = ?', [$id]);
        return view('User.USER_TacheProjet',compact('tachepro','user'));
    }
    public function tacheaujourd(){
        $user=User::find(auth()->user()->id);    
        $tachepro=DB::select('SELECT taches.id,taches.datedebut, taches.datefin, taches.name,taches.etat_tache, taches.description,users.name as employe,projects.name as nameproject FROM taches,users,projects WHERE taches.user_id=users.id and projects.id=taches.project_id  and taches.datedebut=CURDATE() and taches.etat_tache=0 and users.id = :id',['id'=>Auth::id()]);
        return view('User.home',compact('tachepro','user'));
    }


    public function search(Request $request)
    {
        /*$user=User::find(auth()->user()->id);
        $search_text = $_GET['query'];
        $tache = tache::where('name','LIKE','%'.$search_text.'%')->get();

        return view('tache.search',compact('tache','user'));*/
        /*$request->validate([

             'q' => 'required'
        ]);
        
        $q = $request->q;
        $filterTaches = tache::where('name','like','%'.$q.'%')
                              ->orwhere('datefin','like','%'. $q. '%')->get();
        
        if($filterTaches){
            return view('tache.UserIndex')->with([
                'taches' => $filterTaches
            ]);
        }else{
          
        }*/
        $user=User::find(auth()->user()->id);  
         $get_name = $request->search_name;
         $tache = tache::where('name','LIKE','%'.$get_name.'%');
         return view('tache.search',compact('tache','user'));
        

    }

    public function count_tache(){
        $user=User::find(auth()->user()->id);
        $projectList=DB::select('SELECT COUNT(taches.name) from taches,users where taches.user_id=users.id and users.id = :id',['id'=>Auth::id()]);
        return redirect()->route('home')->with([
            'user'=>$user
        ]);   
     }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tache.Userindex');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tache =new tache;
        $tache->name = $request->name;
        $tache->datedebut = $request->datedebut;
        $tache->datefin = $request->datefin;
        $tache->description = $request->description;
        $tache->user_id= Auth::id();
        $tache->save();
        return redirect()->route('User_tache.index')->with([
            'success'=>'Tache ajouté avec succès'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
