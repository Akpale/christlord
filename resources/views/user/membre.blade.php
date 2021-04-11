 @extends('layouts.main')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>

  <div class="card col-md-12" height="750">

    <div class="container-fluid" >

     <div align="center"><h2 class="text-muted"><u><b>Les Membres de l'Eglise</b></u></h2></div> 

      @if(session('success'))

           <div class="alert alert-success" align="center">{{ session('success') }}</div>

       @endif
    
      

       <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Civilité
      </th>
      <th class="th-sm">Nom
      </th>
      <th class="th-sm">Prénoms
      </th>
      <th class="th-sm">Date de Naissance
      </th>
       <th class="th-sm">Profession
      </th>
      <th class="th-sm">Contact
      </th>
      <th class="th-sm">email
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
      <td>{{$membres->contact}}</td>
      <td>{{$membres->email}}</td>
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