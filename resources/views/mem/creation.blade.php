@extends('layouts.main')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar2')
    <!-- /.Navbar -->

  <!--/.Double navigation-->


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

   


<form action="{{route('membres.store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <!-- Grid row -->
  <div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="text" name="prenoms" class="form-control" value="{{ old('prenoms') }}" id="prenoms" >
        <label for="prenoms">Prenoms</label>
        @error('prenoms')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>

    </div>
    <!-- Grid column -->

     <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" id="nom" >
        <label for="nom">Nom</label>
        @error('nom')
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
   
    <!-- Grid column -->
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  

   
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
    <input type="file" name="membre" class="custom-file-input" id="membre" aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="avatar">Parcourir...</label>
    </div>
  </div>
       @error('membre')
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

  <!--Main Layout-->
@stop