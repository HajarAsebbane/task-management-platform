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
                  <thead class="text-center">
                    <tr>
                      <th >#</th>
                      <th >Nom</th>
                      <th >Prenom</th>
                      <th >Email</th>
                      <th >Téléphone</th>
                      <th >Adresse</th>
                     
                      <th style="width: 220px">Actions</th>
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
                      <td>{{$item->email}}</td>
                      <td>{{$item->Téléphone}}</td>
                      <td>{{$item->Adresse}}</td>
                      
                      
                      <td class="d-flex justify-content-center align-items-center">
                        <a href="{{route('BU_user.show',$item->id)}}" class="btn btn-sm btn-primary">
                          <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{route('BU_user.edit',$item->id)}}" class="btn btn-sm btn-warning m-2">
                          <i class="fas fa-edit"></i>
                        </a>

                        <form  id="{{$item->id}}" action="{{route('BU_user.destroy',$item->id)}}"  class="formulario-eliminar" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit"   class="btn btn-sm btn-danger"><i class="fa fa-trash" ></i></button>
                       </form>
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

