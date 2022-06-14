@extends('layouts.appBu')
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
                <form action="{{route('BU_AffecterTache')}}" method="post" class="mt-3">
   
                  @csrf
                  @method('POST')
              
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Employee</label>
                    </div>
                    <select name="user_id" class="custom-select" id="inputGroupSelect01">
                      @foreach ($user as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach 
                      
                    </select>
                  </div>
                  
                  <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle mx-2" aria-hidden="true"></i>Affecter</button>
                   </div>
                  
                  
              
                  
                
                </form>
              </div>
            </div>
           
        </div>
  </div>
</div>
@endsection



