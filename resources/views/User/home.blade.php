@extends('User.dashboardUser')
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
                              <th >Employé</th>
                              <th >Date Debut</th>
                              <th >Date Fin</th>
                              <th >Description</th>
                              <th >Projet</th>
                              <th >Statu</th>
                              <th >Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                                $i=0;
                            @endphp
                              @foreach ( $tachepro as $item ) 
                            <tr>
                              <th scope="row">{{++$i}}</th>
                              <td>{{$item->name}}</td>
                              <td>{{$item->employe}}</td>
                              <td>{{$item->datedebut}}</td>
                              <td>{{$item->datefin}}</td>
                              <td>{{$item->description}}</td>
                              <td>{{$item->nameproject}}</td>
                              <td>
                              @if($item->etat_tache=='0')  
                              <button class="btn btn  btn-secondary"> <div class="spinner-border spinner-border-sm" role="status">
                                
                              </div>
                              <div class="spinner-grow spinner-grow-sm" role="status">
                               
                              </div>en cours</button>
                              @elseif ($item->etat_tache=='1')
                              <button class="btn btn btn-success">Terminé</button>
                                 @endif
                              
                                
                               
                              </td>
                              <td class="d-flex justify-content-center align-items-center">
                      
                               <form method="post">
                                  @method('put')
                                  @csrf
                             <a href="{{route('validate_tache',$item->id)}}" class="btn  btn-sm btn-success m-2">
                              <i class="fa fa-check"></i>
                            </a>
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

        <!--Tache aujourdhui-->