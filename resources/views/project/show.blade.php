@extends('adminlte::page')
@section('content')
<div class="container" >
  <div class="row">
    <div class="col-md-8 mx-auto ">
        <div class="card my-5">
          <div class="card-header">
            <div class="text-center font-weight-bold text-uppercase">
                <h4></h4>
            </div>
          </div>
          <div class="card-body">
        
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">BU</label>
            <input type="texte" disabled name="name" value="{{$user->name}}" class="form-control rounded-0" id="exampleFormControlInput1" placeholder="">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Name</label>
            <input type="texte" disabled name="name" value="{{$project->name}}" class="form-control rounded-0" id="exampleFormControlInput1" placeholder="project name">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Date_Debut</label>
            <input type="texte"  disabled name="datedebut" value="{{$project->datedebut}}"class="form-control rounded-0" id="exampleFormControlInput1" placeholder="Date Debut">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Date_Fin</label>
            <input type="texte"  disabled  name="datefin"  value="{{$project->datefin}}" class="form-control rounded-0" id="exampleFormControlInput1" placeholder="Date Fin">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control rounded-0" disabled  name="description"   rows="3">
            {!!$project->description!!}
            </textarea>
        </div>  
      </div>
    </div>
    
@endsection