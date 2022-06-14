@extends('adminlte::page')

@section('content')

<div class="container">
  @include('layouts.alert')
  <div class="row">
        <div class="col-md-8 mx-auto ">
            <div class="card my-5">
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>Ajouter une Categorie</h4>
                </div>
              </div>
              <div class="card-body">
                <form action="{{route('categorie.store')}}" method="post" class="mt-3">
   
                  @csrf
                  @method('POST')
                  <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="texte" name="name" class="form-control"  placeholder="project name">
                  </div>
                  
                  <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                
                   </div>
                
                </form>
              </div>
            </div>
           
        </div>
  </div>
</div>
@endsection



