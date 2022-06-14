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
                    <h4>list des Categories</h4>
                </div>
              </div>
              <div class="card-body">
                <table id="myTable"  class=" table table-bordered table-stripped">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th >name</th>
                      <th style="width: 220px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=0;
                    @endphp
                      @foreach ( $Categorie as $item ) 
                    <tr>
                      <th scope="row">{{++$i}}</th>
                      <td>{{$item->name}}</td>
                      <td class="d-flex justify-content-center align-items-center">
                       

                        <a href="{{route('categorie.edit',$item->id)}}" class="btn btn-sm btn-warning m-2">
                          <i class="fas fa-edit"></i>
                        </a>

                        <form  id="{{$item->id}}" action="{{route('categorie.destroy',$item->id)}}" class="formulario-eliminar" method="post">
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

<!-- DataTable-->
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
        <!--Delete-->
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
         <!--Fin Delete-->

         
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

    <!--Fin SweetAlert-->
  
@endsection





