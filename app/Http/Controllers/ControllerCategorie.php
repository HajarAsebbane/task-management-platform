<?php

namespace App\Http\Controllers;

use App\Models\Categorie;


use Illuminate\Http\Request;

class ControllerCategorie extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categorie=Categorie::all();
        return view("Categorie.index",compact('Categorie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Categorie =new Categorie;
        $Categorie->name = $request->name;
        $Categorie->save();
        return redirect()->route('categorie.index')->with([
            'success'=>'Categorie ajouté avec succès'
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
        $Categorie=Categorie::find($id);
        return view('Categorie.edit')->with([
            'Categorie' =>$Categorie
        ]);
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
        $Categorie=Categorie::find($id);
        $Categorie->update($request->all());
        return redirect()->route('categorie.index')->with([
            'success'=>'Categorie modifier avec succès'
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
        $Categorie= Categorie::find($id);
        $Categorie->delete();
        return redirect()->route('categorie.index')->with('success','Categorie supprimer avec succès');
    }
   
}
