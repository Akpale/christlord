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
 
<div align="center"><h3 class="text-muted"><u>{{$title ?? ''}}</u></h3>
    
 <!-- Extended material form grid -->

      @if(session('success'))

           <div class="alert alert-success">{{ session('success') }}</div>

       @endif

     </div>

   


<form action="{{route('departements.update',$departement)}}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf
  <!-- Grid row -->
  <div class="row justify-content-center">
    
   <!-- Grid column -->
    <div class="col-md-5">
      <!-- Material input -->
       
      <div class="md-form form-group">
       
        <input type="text" name="libelle" class="form-control" id="libelle" value="{{ old('libelle',$departement->libelle)}}" >
        
        <label for="libelle">Département</label>
        @error('libelle')
           <div class="error">{{ $message }}</div>
         @enderror 
      </div>
    </div>
  </div>  
    <!-- Grid column -->


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