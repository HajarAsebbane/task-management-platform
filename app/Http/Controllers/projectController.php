<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\DataTables\projectDataTable;

class projectController extends Controller
{
    public function indexCat()
    {
        $categorie=Categorie::all();
        return view('Categorie.indexPro',compact('categorie'));
    }
    public function indexCalPro($idcat)
    {
        $projectList=DB::select('SELECT projects.id, projects.name, projects.datedebut, projects.datefin, projects.description,projects.statu,users.name as nameuser FROM users,projects WHERE users.id=projects.user_id and projects.categorie_id = ?', [$idcat]);
        return view('project.index',compact('projectList'));
    }
    public function valider($id)
    {
       $project=project::find($id);
       $project->statu=1;
       $project->save();
       return redirect()->route('ProjetValider')->with([
        'success'=>'Projet validé avec succès'
    ]);;
    }
    public function ProjetValider()
    {
        $projetValider=DB::select('SELECT projects.name,projects.datedebut,projects.datefin,projects.description,projects.statu,categories.name as CategorieName ,users.name as nameuser from projects,categories,users where projects.categorie_id=categories.id and users.id=projects.user_id and projects.statu=1');
        return view('project.ProjetValider',compact('projetValider'));
    }

    public function ProjetEnCours()
    {
        $projetEnCours=DB::select('SELECT projects.name,projects.id,projects.datedebut,projects.datefin,projects.description,projects.statu,categories.name as CategorieName ,users.name as nameuser from projects,categories,users where projects.categorie_id=categories.id and users.id=projects.user_id and projects.statu=0');
        return view('project.ProjetEnCours',compact('projetEnCours'));
    }
   

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $projectList=DB::select('SELECT projects.id, projects.name, projects.datedebut, projects.datefin, projects.description,users.name as nameuser FROM users,projects WHERE users.id=projects.user_id');
        return view('project.index',compact('projectList'));
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //SELECT * FROM `users` WHERE user_type=2;
        $BU=User::where('user_type',2)->get();
        $categorie=Categorie::all();
        return view('project.create',compact('BU','categorie'));
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
        $project->user_id = $request->user_id;
        $project->name = $request->name;
        $project->datedebut = $request->datedebut;
        $project->datefin = $request->datefin;
        $project->description = $request->description;
        $project->categorie_id = $request->categorie_id;
        $project->save();
        return redirect()->route('ProjetEnCours')->with([
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
        return view('project.show',compact('project','user'));

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
        return view('project.edit',compact('project','user','categorie'));
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
        return redirect()->route('indexCat')->with([
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
        return redirect()->route('indexCat')->with('success','Projet supprimer avec succès');
    }
}
