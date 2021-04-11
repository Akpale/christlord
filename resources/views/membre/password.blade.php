@extends('layouts.main2')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar2')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>
 
 
<div align="center"><h3 class="text-muted">Modifier mon mot de passe</h3>
    
 <!-- Extended material form grid -->

      @if(session('success'))

           <div class="alert alert-success">{{ session('success') }}</div>

       @endif

     </div>

   <div class="card col-md-12">


<form action="{{route('update.password2')}}" method="post" enctype="multipart/form-data">
  @csrf
  <!-- Grid row -->
  <div class="row justify-content-center">
    
   <!-- Grid column -->
    <div class="col-md-5">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="password" name="current" class="form-control" value="" id="password">
        <label for="password">Mot de Passe Actuel</label>
        @error('current')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>
    </div>
  </div>  
    <!-- Grid column -->
   
<div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-5">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="password" name="password" class="form-control" value="" id="current">
        <label for="current">Nouveau Mot de Passe</label>
        @error('password')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>
    </div>
    <!-- Grid column -->
</div>


  <!-- Grid row -->
  <div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-5">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="password" name="password_confirmation" class="form-control" value="" id="password_confirmation">
        <label for="password_confirmation">Confirmez Mot de Passe</label>
      </div>
    </div>
    <!-- Grid column -->
  </div>

 <!-- Grid row -->
  <div class="row justify-content-center">
    <!-- Grid column -->
    <div class="col-md-0">
      <!-- Material input -->
      <div class="md-form form-group">
       <button type="submit" class="btn btn-info mt-5"><i class="far fa-edit"></i> Modifier</button>
      </div>
    </div>
    <!-- Grid column -->
  <!-- Grid row -->
 </div>

</form>
<!-- Extended material form grid -->
 </div> 



  </main>
  <!--Main Layout-->
@stop