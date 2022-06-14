

@section('content')

@extends('layouts.appBu')
<div class="container">
  @include('layouts.alert')
  <div class="row">
        <div class="col-md-8 mx-auto ">
            <div class="card my-5">
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>Ajouter un projet</h4>
                </div>
              </div>
              <div class="card-body">
                <form action="{{route('BU_project.store')}}" method="post" class="mt-3">
   
                  @csrf
                  @method('POST')
                  <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="texte" name="name" class="form-control"  placeholder="project name">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Responsable</label>
                    </div>
                    <select name='user_id' class="custom-select" id="inputGroupSelect01">
                      @foreach ($BU as $item)
                          <option  value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach                    
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Categorie</label>
                    </div>
                    <select name='categorie_id' class="custom-select" id="inputGroupSelect01">
                      @foreach ($categorie as $item)
                          <option  value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach                    
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
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                
                   </div>
                
                </form>
              </div>
            </div>
           
        </div>
  </div>
</div>
@endsection



