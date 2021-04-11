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

      <div align="center"><h2 class="text-muted"><b><u>{{$title ?? ''}}</u></b></h2></div>

      @if(session('success'))

           <div class="alert alert-success" align="center">{{ session('success') }}</div>

       @endif
    
       <button type="button" onclick="location.href='{{route('departement.create')}}'" class="btn btn-info"><i class="fas fa-plus-circle"></i> Ajouter</button>

       <table id="dtBasicExample" class="table table-striped table-bordered table-sm " cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm" >ID
      </th>
      <th class="th-sm">Département
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach($departement as $departements)
    <tr>
      <td>{{$departements->id}}</td>
      <td>{{$departements->libelle}}</td>

      <td>
        <a href="{{route('departement.edit',$departements->id)}}"><button><i class="far fa-edit"></i></button></a>
        
        <form action="{{route('departements.destroy',$departements->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet Département?')">
          
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