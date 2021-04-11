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
 
<div align="center"><h3 class="text-muted">{{$accueil ?? ''}}</h3>
    
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
      <!-- Default inline 1-->
      <div class="md-form form-group">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="m" name="civilite" checked>
            <label class="custom-control-label" for="m">M.</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="mme" name="civilite">
            <label class="custom-control-label" for="mme">Mme</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
 
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="mlle" name="civilite">
            <label class="custom-control-label" for="mlle">Mlle</label>
          </div>
      </div>

    </div>
    <!-- Grid column -->

     <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" id="nom">
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
        <input type="text" name="prenoms" class="form-control" value="{{ old('prenoms') }}" id="prenoms">
        <label for="prenoms">Prénoms</label>
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
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email">
        <label for="email">Email</label>
        @error('email')
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
    
    <!-- Grid column -->
<!--/Blue select-->
   <div class="col-md-4">
     <div class="md-form form-group">
          <input type="text" name="profession" class="form-control" value="{{ old('profession') }}" id="profession">
          <label for="profession">Profession</label>
          @error('profession')
           <div class="error">{{ $message }}</div>
         @enderror 
         </div>
   </div>
<!--/Blue select-->
  <div class="col-md-4">
     <div class="md-form form-group">
          <input type="text" name="contact" class="form-control" value="{{ old('contact') }}" id="contact">
          <label for="contact">Contact</label>
          @error('contact')
           <div class="error">{{ $message }}</div>
         @enderror 
         </div>
   </div>
   
  </div>

   <!-- Grid row -->
  <div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-4">
      <!-- Material input -->
     <div class="md-form form-group">
       
        <!-- Default inline 1-->
          <div class="md-form md-outline input-with-post-icon datepicker">
            <input placeholder="Select date" type="date" id="date_naissance" name="date_naissance" class="form-control">
            <label for="date_naissance">Date de naissance</label>
          </div>
      </div>

    </div>
    <!-- Grid column -->

  <!-- Grid column -->
    <div class="col-md-4 mt-4">
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