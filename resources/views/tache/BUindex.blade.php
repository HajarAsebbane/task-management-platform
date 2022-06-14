
@extends('layouts.appBu')

@section('content')

<div class="container">
  <div class="row">
        <div class="col-md-12 mx-auto ">
            <div class="card my-5">
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>list des Projets</h4>
                </div>
              </div>
              <div class="card-body">
                <table id="myTable"  class=" table table-bordered table-stripped">
                  <thead class="text-center">
                    <tr>
                      <th >#</th>
                      <th >Nom</th>
                      <th >Date Debut</th>
                      <th >Date Fin</th>
                      <th >Description</th>
                      <th >Bu</th>
                      <th style="width: 180px">Actions</th>
                    </tr>
                  </thead>
                   <tbody>
                    @php
                        $i=0;
                    @endphp
                      @foreach ( $projectList as $item ) 
                    <tr>
                      <th scope="row">{{++$i}}</th>
                      <td>{{$item->name}}</td>
                      <td>{{$item->datedebut}}</td>
                      <td>{{$item->datefin}}</td>
                      <td>{{$item->description}}</td>
                      <td>{{$item->nameuser}}</td>
                      
                      <td class="d-flex justify-content-center align-items-center">
                        <a href="{{route('BU_showtache',$item->id)}}" class="btn btn-sm btn-primary">
                          <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{route('BU_tache.show',$item->id)}}" class="btn btn-sm btn-dark m-2">
                          <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>

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

@section('js')
   <script>
      $(document).ready(function(){
        $('#myTable').DataTable({
           dom : 'Bfrtip',
           buttons : [
              'copy','excel','csv','pdf','print','colvis'
           ]
        });

      });
   </script>

      <!--Sweet Alert-->
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


      
      
