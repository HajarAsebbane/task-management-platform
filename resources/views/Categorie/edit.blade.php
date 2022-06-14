@extends('adminlte::page')
@section('content')
<div class="container" >
  @include('layouts.alert')
  <div class="row">
    <div class="col-md-8 mx-auto ">
        <div class="card my-5">
          <div class="card-header">
            <div class="text-center font-weight-bold text-uppercase">
                <h4>Modifier une Categorie</h4>
            </div>
          </div>
          <div class="card-body">
        <form action="{{route('categorie.update',$Categorie->id)}}" method="POST" class="mt-3">
          @csrf
          @method('PUT')
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Name</label>
            <input type="texte" name="name" value="{{$Categorie->name}}" class="form-control" id="exampleFormControlInput1" placeholder="project name">
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