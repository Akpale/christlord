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

     <div align="center" class="mt-3"><h2 class="text-muted"><u><b>Les Membres de l'Eglise par Département</b></u></h2></div> 

      @if(session('success'))

           <div class="alert alert-success" align="center">{{ session('success') }}</div>

       @endif
    <form action="{{route('recherche')}}" method="POST" >
       <div class="row justify-content-center mt-5">    
<!--/Blue select-->

       @csrf
         <div class="col-md-4">
          <select class="mdb-select md-form colorful-select dropdown" name="departement_id" onChange="submit()">

         <option value="">Sélectionner...</option>  
       @foreach($departement as $departements)
         
        <option value="{{ $departements->id }}">{{$departements->libelle}}</option>
         @endforeach   
            </select>
        @error('departement')
              <div class="error">{{ $message }}</div>
        @enderror 
         <label class="mdb-main-label text-muted"><h6>Département</h6></label>

         </div>
 
         </div>
      </form>
<!--/Blue select-->

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