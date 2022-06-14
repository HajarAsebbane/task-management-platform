@extends('layouts.appBu')
@section('content')

<div class="container">
  @include('layouts.alert')
  <div class="row">
        <div class="col-md-10 mx-auto ">
            <div class="card my-5">
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>list des utilisateurs</h4>
                </div>
              </div>
              <div class="card-body">
                <table id="myTable"  class=" table table-bordered table-stripped">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th >Nom</th>
                      <th >Prenom</th>
                      <th >Téléphone</th>
                      <th >Adresse</th>
                      <th >Email</th>
                     
                      <th style="width: 100px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=0;
                    @endphp
                      @foreach ( $user as $item ) 
                    <tr>
                      <th scope="row">{{++$i}}</th>
                      <td>{{$item->name}}</td>
                      <td>{{$item->Prenom}}</td>
                      <td>{{$item->Téléphone}}</td>
                      <td>{{$item->Adresse}}</td>
                      <td>{{$item->email}}</td>


                      <td class="d-flex justify-content-center align-items-center">
                        <a href="{{route('BU_Periode',$item->id)}}" class="btn btn-sm btn-danger">
                          <i class="fa fa-file-pdf"></i>
                        </a>
                  </td>
                  </td>
                  </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
           
        </div>
  </div>
</div>
@endsection




