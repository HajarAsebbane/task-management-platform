@extends('adminlte::page')
@section('plugins.Datatables',true)
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
                        <a href="{{route('Periode',$item->id)}}" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <i class="fa fa-file-pdf"></i>
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


          <!-- SweetAlert-->
             <!--Dalete-->
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      @if ( session('eliminar')=='ok')
        <script>
          Swal.fire(
            'Supprimer!',
            'Votre enregistrement a été supprimé.',
            'Succès'
          )
        </script>
      @endif

      <script>

        $('.formulario-eliminar').click(function(e){
          e.preventDefault();

          Swal.fire({
        title: 'Vous-etes sûr?',
      text: "Vous ne pourrez pas revenir en arrière!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'oui ,supprimer!',
        cancelButtonText: 'anuuler'
      }).then((result) => {
        if (result.isConfirmed) {
          
        this.submit();
        }
      })
        });

      </script>
      <!--Fin Dalete-->
  
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
     <!-- SweetAlert-->
@endsection

