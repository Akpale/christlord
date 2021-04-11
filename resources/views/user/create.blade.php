 @extends('layouts.main')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>
 
<div class="card">
  
<div align="center"><h3 class="text-muted">Créer un utilisateur</h3>
    
 <!-- Extended material form grid -->

      @if(session('success'))

           <div class="alert alert-success">{{ session('success') }}</div>

       @endif

     </div>

   


<form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
	@csrf
  <!-- Grid row -->
  <div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="text" name="pseudo" class="form-control" value="{{ old('pseudo') }}" id="pseudo" >
        <label for="pseudo">Pseudo</label>
        @error('pseudo')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>

    </div>
    <!-- Grid column -->

     <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="nom" >
        <label for="name">Nom</label>
        @error('name')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>
    </div>
  </div>
    <!-- Grid column -->
<div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" >
        <label for="email">Email</label>
        @error('email')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="password" name="password" class="form-control" id="password" >
        <label for="password">Mot de Passe</label>
        @error('password')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>
    </div>
    <!-- Grid column -->
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <!--Blue select-->
       <!--Blue select-->
      <select class="mdb-select md-form colorful-select dropdown" name="gpusers_id">
        <option value="2">Administrateur</option>
        <option value="3">Sécretariat</option>
        <option value="4">Utilisateur</option>
      </select>
      <label class="mdb-main-label text-muted"><h6>Profil</h6></label>

    </div>
    <!-- Grid column -->
<!--/Blue select-->
<div class="col-md-4">
     <select class="mdb-select md-form colorful-select dropdown" name="departement_id">

        @foreach($departement as $departements)  
        <option value="{{ $departements->id }}">{{$departements->libelle}}</option>
         @endforeach   
        </select>
        @error('departement')
              <div class="error">{{ $message }}</div>
        @enderror 
      <label class="mdb-main-label text-muted"><h6>Département</h6></label>
</div>
<!--/Blue select-->

   
  </div>

<div class="row justify-content-center">
   <!-- Grid column -->
    <div class="col-md-6">
      <!-- Material input -->
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Ajouter une photo</span>
  </div>
    <div class="custom-file">
    <input type="file" name="avatar" class="custom-file-input" id="avatar" aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="avatar">Parcourir...</label>
    </div>
  </div>
       @error('avatar')
           <div class="error">{{ $message }}</div>
      @enderror 
    </div>
    <div class="col-md-2">
    </div>
 </div>
    <!-- Grid column -->
  <!-- Grid row -->
<div class="row justify-content-center">
  <!-- Grid row -->
  <div class="col-md-3">
    
    <button type="submit" class="btn btn-info mt-5 col-md-12"><i class="fas fa-plus-circle"></i> Enregistrer</button>
    
  </div>

  <!-- Grid row -->
 </div> 

</form>
<!-- Extended material form grid -->
 </div> 



  </main>
  <!--Main Layout-->
@stop