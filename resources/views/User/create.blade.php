@extends('adminlte::page')

@section('content')

<div class="container">
  @include('layouts.alert')
  <div class="row">
        <div class="col-md-8 mx-auto ">
            <div class="card my-5">
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>Ajouter un Utilisateur</h4>
                </div>
              </div>
              <div class="card-body">
                <form action="{{route('user.store')}}" method="post" class="mt-3">
   
                  @csrf
                  @method('POST')
                  <div class="form-group mb-3">
                    <label for="name">Nom</label>
                    <input type="texte" name="name" class="form-control"  placeholder="nom utilisateur">
                  </div>
                  <div class="form-group mb-3">
                    <label for="name">Prenom</label>
                    <input type="texte" name="Prenom" class="form-control"  placeholder="Prenom utilisateur">
                  </div>
                  <div class="form-group mb-3">
                    <label for="name">Email</label>
                    <input type="email" name="email" class="form-control"  placeholder="user email">
                  </div>
                  <div class="form-group mb-3">
                    <label for="name">Téléphone</label>
                    <input type="texte" name="Téléphone" class="form-control"  placeholder="Téléphone ">
                  </div>
                  <div class="form-group mb-3">
                    <label for="name">Adresse</label>
                    <input type="texte" name="Adresse" class="form-control"  placeholder="Adresse ">
                  </div>
                  <div class="form-group mb-3">
                    <label for="name">Encaderant BU</label>
                   
                  </div>
                 {{-- <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Employee</label>
                  </div>--}}
                  <select name="user_id" class="custom-select" id="inputGroupSelect01">
                    @foreach ($userBU as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach 
                    <option value="">NULL</option>                        
                  </select><br><br>
                  
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



