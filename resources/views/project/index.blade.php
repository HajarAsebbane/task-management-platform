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
                      <th  >Statu</th>
                      <th>Actions</th>
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
                      <td>
                        @if($item->statu=='0')  
                       
                          <button class="btn btn-sm  btn-secondary"> <div class="spinner-border spinner-border-sm" role="status">
                        
                          </div>
                          <div class="spinner-grow spinner-grow-sm" role="status">
                           
                          </div>en cours</button>
                        @elseif ($item->statu=='1')
                        <button class="btn btn-sm btn-success">Termin??</button>
                           @endif
                        </td>
                      <td class="d-flex justify-content-center align-items-center">
                        <a href="{{route('showtache',$item->id)}}" class="btn btn-sm btn-primary">
                          <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{route('project.edit',$item->id)}}" class="btn btn-sm btn-warning m-2">
                          <i class="fas fa-edit"></i>
                        </a>

                        <form  id="{{$item->id}}" action="{{route('project.destroy',$item->id)}}"  class="formulario-eliminar" method="post">
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
            'Votre enregistrement a ??t?? supprim??.',
            'Succ??s'
          )
        </script>
      @endif

      <script>

        $('.formulario-eliminar').click(function(e){
          e.preventDefault();

          Swal.fire({
        title: 'Vous-etes s??r?',
       text: "Vous ne pourrez pas revenir en arri??re!",
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

