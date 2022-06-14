<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\DataTables\projectDataTable;

class BU_ControllerProject extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexCat()
    {
       // $Categorie=DB::select('SELECT categories.id, categories.name FROM categories,projects WHERE categories.id=projects.categorie_id and projects.user_id = ? GROUP BY categories.id, categories.created_at, categories.updated_at, categories.name ',[Auth::id()]);
        //return view('BU.dashboardBU',compact('Categorie'));
        return view ('BU.dashboardBU');
    }
    
   
    public function index()
    {
        $projectList=DB::select('SELECT projects.id, projects.name, projects.datedebut, projects.datefin, projects.description,projects.statu,users.name as nameuser FROM users,projects WHERE users.id=projects.user_id and projects.user_id = ?',[Auth::id()]);
        return view('project.BUindex',compact('projectList'));
    }

   


    public function valider($id)
    {
        $project=project::find($id);
        $project->statu=1;
        $project->save();
       return redirect()->route('BU_ProjetValider')->with([
        'success'=>'Projet validé avec succès'
    ]);;
    }
    public function ProjetValider()
    {
       $projetValider=DB::select('SELECT projects.id, projects.name, projects.datedebut, projects.datefin, projects.description,projects.statu,users.name as nameuser FROM users,projects WHERE users.id=projects.user_id and projects.statu=1 and projects.user_id = ?',[Auth::id()]); 
       return view('project.BUProjetValider',compact('projetValider'));
    }

    public function ProjetEnCours()
    {
        $projetEnCours=DB::select('SELECT projects.id, projects.name, projects.datedebut, projects.datefin, projects.description,projects.statu,users.name as nameuser FROM users,projects WHERE users.id=projects.user_id and projects.statu=0 and projects.user_id = ?',[Auth::id()]); 
        return view('project.BUProjetEnCours',compact('projetEnCours'));


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $BU=User::where('id',Auth::id())->get();
        $categorie=DB::select('SELECT categories.id, categories.created_at, categories.updated_at, categories.name FROM categories,projects WHERE categories.id=projects.categorie_id and projects.user_id = ?  GROUP BY categories.id, categories.created_at, categories.updated_at, categories.name',[Auth::id()]);
        return view('project.BUcreate',compact('BU','categorie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project =new project;
        $project->user_id = Auth::id();
        $project->name = $request->name;
        $project->datedebut = $request->datedebut;
        $project->datefin = $request->datefin;
        $project->description = $request->description;
        $project->categorie_id = $request->categorie_id;
        $project->save();
        return redirect()->route('BU_project.index')->with([
            'success'=>'Projet ajouté avec succès'
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
        $project=project::where('id',$id)->get();
        
        //$project=project::find($id);
        //$user=User::where('id',$project->user_id)->get();
        $user=User::where('id',$id)->get();
        
        //$user=DB::select('select * from users where id = ?', [$project->user_id]);
        return view('project.BUshow',compact('project','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=project::find($id);
        $user=User::where('user_type',2)->get();
        $categorie=Categorie::all();
        return view('project.BUedit',compact('project','user','categorie'));
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
        $project=project::find($id);
        $project->update($request->all());
        return redirect()->route('BU_project.index')->with([
            'success'=>'Projet modifier avec succès'
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
        $project= project::find($id);
        $project->delete();
        return redirect()->route('BU_project.index')->with('success','Projet supprimer avec succès');
    }
}
