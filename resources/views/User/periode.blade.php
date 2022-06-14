@extends('adminlte::page')

@section('content')

<div class="container">
  @include('layouts.alert')
  <div class="row">
        <div class="col-md-8 mx-auto ">
            <div class="card my-5">
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>Lister une Periode</h4>
                </div>
              </div>
              <div class="card-body">
                <form action="{{route('pdf')}}" method="post" class="mt-3">
   
                  @csrf
                  @method('POST')
                  <div class="form-group mb-3">
                    <label for="datedebut">Date Debut</label>
                    <input type="date" name="datedebut" class="form-control"  placeholder="Date Debut">
                  </div>
                  <div class="form-group mb-3">
                    <label for="datefin">Date Fin</label>
                    <input type="date" name="datefin" class="form-control"  placeholder="Date Fin">
                  </div>
                  
                  <button type="submit" class="btn btn-warning">
                      <i class="fas fa-file-pdf"></i>
                      Télécharger <b>PDF</b>
                  </button>
                
                </form>
              </div>
            </div>
           
        </div>
  </div>
</div>
@endsection



