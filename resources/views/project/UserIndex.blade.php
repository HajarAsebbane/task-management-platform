
@extends('User.dashboardUser')
@section('content')

<div class="container">
  <div class="row">
    
        <div class="col-md-20 mx-auto ">
          <button type="button" class="btn btn-outline-primary my-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter Tache <i class="fas fa-user-plus"></i></button>

            <div class="card my-3">
              
              
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                  
                    <h4>list des projets</h4>
                </div>
              </div>
              <div class="card-body">
                <table id="myTable"  class=" table table-bordered table-stripped">
                  <thead class="text-center">
                    <tr>
                      <th >#</th>
                      <th >Nom</th>
                      <th >Date Debut</th>
                      <th >Data Fin</th>
                      <th >Description</th>
                      <th  >Statu</th>
                      <th  >Taches</th>
                    </tr>
                  </thead>
                   <tbody>
                    @php
                        $i=0;
                    @endphp
                      @foreach ( $UserProject as $item ) 
                    <tr>
                      <th scope="row">{{++$i}}</th>
                      <td>{{$item->name}}</td>
                      <td>{{$item->datedebut}}</td>
                      <td>{{$item->datefin}}</td>
                      <td>{{$item->description}}</td>
                      
                     
                      
                      <td>
                        @if($item->statu=='0')  
                        <button class="btn btn  btn-secondary"> <div class="spinner-border spinner-border-sm" role="status">
                          
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                         
                        </div>en cours</button>
                        @elseif ($item->statu=='1')
                        <button class="btn btn btn-success">Terminé</button>
                           @endif
                        </td>
                        <td class="d-flex justify-content-center align-items-center">
                          <a href="{{route('User_showtache',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
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






      
      
