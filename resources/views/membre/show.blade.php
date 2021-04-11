 @extends('layouts.main')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar2')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>

  <div class="card col-md-12">

    <div class="container-fluid" >

      <div align="center"><h2 class="text-muted"><u><b>Les Membres de l'Eglise</b></u></h2></div> 

      @if(session('success'))

           <div class="alert alert-success" align="center">{{ session('success') }}</div>

       @endif
    
       <button type="button" onclick="location.href='{{route('membres.create')}}'" class="btn btn-info"><i class="fas fa-plus-circle"></i> Ajouter</button>

       <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm" >Civilité
      </th>
      <th class="th-sm">Nom
      </th>
      <th class="th-sm">Prénoms
      </th>
      <th class="th-sm">Date de Naissance
      </th>
      <th class="th-sm">Profession
      </th>
      <th class="th-sm">Email
      </th>
      <th class="th-sm">Contact
      </th>
       <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach($membre as $membres)
    <tr>
      <td>{{$membres->civilite}}</td>
      <td>@if(!empty($membres->photo->filename))<img class="img-circle" src="{{ $membres->photo->thumb_url }}" width="40" height="40">@endif{{$membres->nom}}</td>
      <td>{{$membres->prenoms}}</td>
      <td>{{date('d-m-Y',strtotime($membres->date_naissance))}}</td>
      <td>{{$membres->profession}}</td>
      <td>{{$membres->email}}</td>
      
      <td>{{$membres->contact}}</td>

      <td>
        <a href="{{route('membres.edit',$membres->id)}}"><button><i class="far fa-edit"></i></button></a>
        
        <form action="{{route('membres.destroy',$membres->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet Membre ?')">
          
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