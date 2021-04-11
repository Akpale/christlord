 @extends('layouts.main')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>

  <div class="card col-md-12">

    <div class="container-fluid" >

      <div align="center"><h2 class="text-muted"><u><b>Espace Administrateur</b></u></h2></div> 

      @if(session('success'))

           <div class="alert alert-success" align="center">{{ session('success') }}</div>

       @endif
    
       <button type="button" onclick="location.href='{{route('users.create')}}'" class="btn btn-info"><i class="fas fa-plus-circle"></i> Ajouter</button>

       <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm" >Pseudo
      </th>
      <th class="th-sm">Nom
      </th>
      <th class="th-sm">Email
      </th>
      <th class="th-sm">Profil
      </th>
      <th class="th-sm">Département
      </th>
      <th class="th-sm">Statut
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{$user->pseudo}}</td>
      <td>@if(!empty($user->avatar->filename))<img class="img-circle" src="{{ $user->avatar->thumb_url }}" width="40" height="40">@endif{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->gpuser->profil}}</td>
      <td>{{$user->departement->libelle}}</td>
      
      <td><div id="statut" align="center">{{$user->statut->statut}}</div></td>

      <td>
        <a href="{{route('user.edit',$user->id)}}"><button><i class="far fa-edit"></i></button></a>
        
        <form action="{{route('users.destroy',$user->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet Utilisateur?')">
          
          @csrf
          @method('DELETE')
                     
          <button type="submit"><i class="fas fa-trash-alt"></i></button>

        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
      <br>
    </div>
 </div>
  </main >
  <!--Main Layout-->
@stop