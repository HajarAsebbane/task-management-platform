@extends('layouts.appBu')
@section('content')
<div class="container" >
  @include('layouts.alert')
  <div class="row">
    <div class="col-md-8 mx-auto ">
        <div class="card my-5">
          <div class="card-header">
            <div class="text-center font-weight-bold text-uppercase">
                <h4>Modifier un projet</h4>
            </div>
          </div>
          <div class="card-body">
        <form action="{{route('BU_project.update',$project->id)}}" method="POST" class="mt-3">
          @csrf
          @method('PUT')
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Name</label>
            <input type="texte" name="name" value="{{$project->name}}" class="form-control" id="exampleFormControlInput1" placeholder="project name">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Responsable</label>
            </div>
            <select name="user_id" class="custom-select" id="inputGroupSelect01">
              @foreach ($user as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach                    
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Categorie</label>
            </div>
            <select name="categorie_id" class="custom-select" id="inputGroupSelect01">
              @foreach ($categorie as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach                    
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Date_Debut</label>
            <input type="texte" name="datedebut" value="{{$project->datedebut}}"class="form-control" id="exampleFormControlInput1" placeholder="Date Debut">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Date_Fin</label>
            <input type="texte" name="datefin"  value="{{$project->datefin}}" class="form-control" id="exampleFormControlInput1" placeholder="Date Fin">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control"  name="description"   rows="3">
            {!!$project->description!!}
            </textarea>
          </div>

          <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        
          </div>
        
        </form>
      </div>
    </div>
    @if(session()->has('success'))
    <script>
      Swal.fire({
         position: 'top-end',
         icon: 'success',
         title: "{{session()->get('success')}}",
         showConfirmButton: false,
         timer: 2500
});

    </script>
@endif
@endsection