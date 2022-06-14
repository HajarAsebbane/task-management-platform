@extends('User.dashboardUser')

@section('content')


      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->Prenom }} {{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">Développeure</p>

                

               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Informations personnelles</a></li>
                  <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Changer mot de passe</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 

                  
                 

                  <div class="active tab-pane" id="personal_info">
                    <form class="form-horizontal" action="{{route('User_Info.update',$user->id)}}" method="POST" >
                      @csrf
                      @method('PUT')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" value="{{$user->name}}" class="form-control" id="inputName"  placeholder="Nom">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Prenom</label>
                        <div class="col-sm-10">
                          <input type="text" name="Prenom" value="{{$user->Prenom}}" class="form-control" id="inputName" placeholder="Prenom">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" value="{{$user->email}}" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Adresse</label>
                        <div class="col-sm-10">
                          <input type="text" name="Adresse" value="{{$user->Adresse}}" class="form-control" id="inputName2" placeholder="Adresse">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Téléphone</label>
                        <div class="col-sm-10">
                          <input type="text" name="Téléphone" value="{{$user->Téléphone}}" class="form-control" id="inputName2" placeholder="Adresse">
                        </div>
                      </div>
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Update</button>
                    
                      </div>
                      {{--<div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Enregistrer</button>
                        </div>
                      </div>--}}  
                    </form>
                  </div>
                {{-- <div class="tab-pane" id="change_password">
                    <form class="form-horizontal" method="POST" action="{{route('editPassword')}}">
                      @csrf
                      @method('PUT')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Ancien mot de passe</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control" id="inputName" placeholder="Ancien mot de passe">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nouveau mot de passe</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control" id="inputEmail" placeholder="Nouveau mot de passe">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-3 col-form-label">Confirmer mot de passe</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control" id="inputName2" placeholder="Confirmer mot de passe">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Enregistrer</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>--}}
                <div class="tab-pane" id="change_password">
                <form method="POST" action="{{route('editPassword')}}">
                  @csrf
                  @method('PUT')
              <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                      <div class="form-group">
                          <input type="password"
                              class="form-control form-control-user"
                              aria-describedby="emailHelp"
                              name="oldpassword"
                              placeholder="Entrer votre mot de passe actuelle">
                      </div>
                      <div class="form-group">
                          <input type="password" 
                              class="form-control form-control-user"
                              aria-describedby="emailHelp" 
                              name="password"
                              placeholder="Entrer votre nouveau mot de passe ">
                      </div>

                      <div class="form-group">
                          <input type="password" 
                              class="form-control form-control-user"
                              aria-describedby="emailHelp" 
                              name="password_confirmation"
                              placeholder=" Confirmer votre nouveau mot de passe">
                      </div>
                      <button type="submit" class="btn btn-primary">Enregistrer</button>
                  </div>
              </div>
          </form>
        </div>

                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  
   




  @endsection