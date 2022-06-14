@extends('adminlte::page')

@section('title')

      Home | laravel Taches App

@endsection

@section('content')
     <div class="container-fluid">
           <div class="row ">
            @foreach ( $categorie as $item ) 
                 <div class="col-lg-4 col-6">
                   
                       <div class="small-box bg-info">
                             <div class="inner">
                               <h3>{{\App\Models\project::count()}}</h3>
                               
                               <p>{{$item->name}}</p>
                               
                             </div>
                             <div class="icon">
                               <i class="fas fa-desktop"></i>
                             </div>
                             <a href="{{route('indexCalPro',$item->id)}}"  class="small-box-footer">
                                Liste Projet <i class="fas fa-arrow-circle-right"></i>
                             </a>
                         
                       </div>
                  
                 </div>
                 @endforeach  
           </div>
     </div>

@endsection