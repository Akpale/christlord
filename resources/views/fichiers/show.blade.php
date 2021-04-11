 @extends('layouts.main3')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar3')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>

  <div class="card col-md-12">

    <div class="container-fluid" >

      <div align="center"><h2 class="text-muted"><u><b>{{ $description ?? '' }}</b></u></h2></div> 

      @if(session('success'))

           <div class="alert alert-success" align="center">{{ session('success') }}</div>

       @endif
    
       <button type="button" onclick="location.href='{{route('fichiers.create')}}'" class="btn btn-info"><i class="fas fa-plus-circle"></i> Ajouter</button>

       <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Date
      </th>
      <th class="th-sm">Description de l'activité
      </th>
      <th class="th-sm">Fichier
      </th>
      <th class="th-sm">Télécharger
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach($fichiers as $fichier)
    <tr>
      <td>{{date('d-m-Y',strtotime($fichier->date_activite))}}</td>
      <td>{{$fichier->description}}</td>
      <td>{{$fichier->filename}}</td>
      <td><a  href="{{$fichier->url}}" download="{{$fichier->filename}}"><h6 style="color:#0099CC;">Télécharger</h6></a></td>
      

      <td>
        <!--a href="{{route('fichiers.edit',$fichier->id)}}"><button><i class="far fa-edit"></i></button></a-->
        
        <form action="{{route('fichiers.destroy',$fichier->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet document ?')">
          
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