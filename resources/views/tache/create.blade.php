@extends('adminlte::page')

@section('content')

<div class="container">
  @include('layouts.alert')
  <div class="row">
        <div class="col-md-8 mx-auto ">
            <div class="card my-5">
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>Ajouter une Tache</h4>
                </div>
              </div>
              <div class="card-body">
                <form action="{{route('tache.store')}}" method="post" class="mt-3">
   
                  @csrf
                  @method('POST')
              
                 
                  <div class="form-group mb-3">
                    <input type="hidden" name="project_id" class="form-control"  placeholder="user-id" value='{{$project->id}}'>
                  </div>
                  
                  <div class="form-group mb-3">
                    <label for="name">Nom</label>
                    <input type="texte" name="name" class="form-control"  placeholder="Nom tache">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Employee</label>
                    </div>
                    <select name="user_id" class="custom-select" id="inputGroupSelect01">
                      @foreach ($userBU as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach 
                      <option value="">NULL</option>                        
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="datedebut">Date_Debut</label>
                    <input type="date" name="datedebut" class="form-control"  placeholder="Date Debut">
                  </div>
                  <div class="form-group mb-3">
                    <label for="datefin">Date_Fin</label>
                    <input type="date" name="datefin" class="form-control" placeholder="Date Fin">
                  </div>
                  <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control"  name="description" rows="3"></textarea>
                  </div>
              
                  <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle mx-2" aria-hidden="true"></i>Ajouter</button>
                   </div>
                
                </form>
              </div>
            </div>
           
        </div>
  </div>
</div>
@endsection



