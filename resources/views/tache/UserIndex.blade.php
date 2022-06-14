
@extends('User.dashboardUser')
@section('content')

<div class="container">
  <div class="row">
    
        <div class="col-md-20 mx-auto ">
          <button type="button" class="btn btn-outline-primary my-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter Tache <i class="fas fa-user-plus"></i></button>

            <div class="card my-3">
              
              
              <div class="card-header">
                <div class="text-center font-weight-bold text-uppercase">
                  
                    <h4>list des taches</h4>
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
                      <th  class='my'style="width: 160px">Statu</th>
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
                  </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
            </div>
           
        </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Tache</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form   action="{{route('User_tache.store')}}" method="post" class="mt-3">
   
          @csrf
          @method('POST')
          <div class="input-group mb-3">  
          </div>
          <div class="form-group mb-3">
            <label for="name">Nom</label>
            <input type="texte" name="name" class="form-control"  placeholder="tache name">
          </div>
          <div class="form-group mb-3">
            <label for="datedebut">Date_Debut</label>
            <input type="date" name="datedebut" class="form-control"  placeholder="Date Debut">
          </div>
          <div class="form-group mb-3">
            <label for="datefin">Date_Fin</label>
            <input type="date" name="datefin" class="form-control" placeholder="Date Fin">
          </div>
          <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control"  name="description" rows="3"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button  type="submit" class="btn btn-primary">Ajouter</button>
          </div>
        
        </form>
      </div>
      
    </div>
  </div>
</div>
@endsection






      
      
