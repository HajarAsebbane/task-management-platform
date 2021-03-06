
@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('content')

<div class="container">
  <div class="row">
   
        <div class="col-md-15 mx-auto ">
            <div class="card my-5">
              
              <div class="card-header">
               
                <div class="text-center font-weight-bold text-uppercase">
                    <h4>list des Tache</h4>
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
                      <th >Projet</th>
                      <th  class='my'style="width: 160px">Statu</th>
                      <th style="width: 220px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=0;
                    @endphp
                      @foreach ( $tacheUser as $item ) 
                    <tr>
                      <th scope="row">{{++$i}}</th>
                      <td>{{$item->name}}</td>
                      <td>{{$item->datedebut}}</td>
                      <td>{{$item->datefin}}</td>
                      <td>{{$item->description}}</td>
                      <td>{{$item->project}}</td>
                      

                      <td>
                        @if($item->etat_tache=='0')  
                        <button class="btn btn  btn-secondary"> <div class="spinner-border spinner-border-sm" role="status">
                          
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                         
                        </div>en cours</button>
                        @elseif ($item->etat_tache=='1')
                        <button class="btn btn btn-success">Termin??</button>
                           @endif
                        
                          
                         
                        </td>
                      <td class="d-flex justify-content-center align-items-center">
                        

                        <a href="{{route('tache.edit',$item->id)}}" class="btn btn-sm btn-warning m-2">
                          <i class="fas fa-edit"></i>
                        </a>

                        <form  id="{{$item->id}}" action="{{route('tache.destroy',$item->id)}}" class="formulario-eliminar" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit"  onclick="deleteProject({{$item->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash" ></i></button>
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
      $(document).ready(function)(){
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


      
      
