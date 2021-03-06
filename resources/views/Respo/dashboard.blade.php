@extends('adminlte::page')

@section('title')

      Home | laravel Taches App

@endsection
@section('content')
<div class="container-fluid">
      <div class="row">
            <div class="col-lg-3 col-6">     
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{\App\Models\project::count()}}</h3>

            <p>Projets</p>
          </div>
          <div class="icon">
            <i class="fa fa-laptop"></i>
          </div>
          <a href="{{url('indexCat')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{\App\Models\tache::count()}}<sup style="font-size: 20px"></sup></h3>

            <p>Taches</p>
          </div>
          <div class="icon">
            <i class="fa fa-hourglass-half"></i>
          </div>
          <a href="{{url('/tache')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{\App\Models\User::count()}}</h3>

            <p>Users</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a href="{{url('/user')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{\App\Models\Categorie::count()}}</h3>

            <p>Categories</p>
          </div>
          <div class="icon">
            <i class="fa fa-crosshairs"></i>
          </div>
          <a href="{{url('/categorie')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->

           
        <!--Tache aujourdhui-->
     <div class="container">
          <div class="row">
                <div class="col-md-10 mx-auto ">
                    <div class="card my-5">
                      <div class="card-header">
                        <div class="text-center font-weight-bold text-uppercase">
                            <h4>list des Tache d'Aujourd'hui</h4>
                        </div>
                      </div>
                      <div class="card-body">
                        <table id="myTable"  class=" table table-bordered table-stripped">
                          <thead>
                            <tr>
                              <th >#</th>
                              <th >Nom</th>
                              <th >Employ??</th>
                              <th >Date Debut</th>
                              <th >Date Fin</th>
                              <th >Description</th>
                              <th >Projet</th>
                              <th >Statu</th>
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
                              <button class="btn btn btn-success">Termin??</button>
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
        

        <!--Tache aujourdhui-->
        
      </div>
    </div>
</div>


<!-- Pie chart -->



@endsection




