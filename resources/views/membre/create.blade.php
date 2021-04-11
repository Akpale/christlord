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

   


<form action="{{route('membres.store')}}" name="form" id="form" method="POST" enctype="multipart/form-data">
 
  @csrf


<ul class="stepper horizontal" id="horizontal-stepper">
  <li class="step active">
    <div class="step-title waves-effect waves-dark">Etape 1</div>
    <div class="step-new-content">
      <div class="row">
        <div class="md-form col-4 ml-auto">
          <!-- Material input -->
         <select class="mdb-select md-form colorful-select dropdown" name="civilite">
        <option value="M.">M.</option>
        <option value="Mme">Mme</option>
        <option value="Mlle">Mlle</option>
        </select>
       <label class="mdb-main-label text-muted"><h6>Civilité</h6></label>

        </div>

        <div class="md-form col-4 ml-auto">
          <!-- Material input -->
         <div class="md-form form-group">
          <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" id="nom" required>
          <label for="nom">Nom</label>
          @error('nom')
           <div class="error">{{ $message }}</div>
         @enderror 
         </div>

        </div>

        <div class="md-form col-4 ml-auto">
          <!-- Material input -->
         <div class="md-form form-group">
          <input type="text" name="prenoms" class="form-control" value="{{ old('prenoms') }}" id="prenoms" required>
          <label for="prenoms">Prénoms</label>
          @error('prenoms')
           <div class="error">{{ $message }}</div>
         @enderror 
         </div>

        </div>
      </div>
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-info next-step" data-feedback="someFunction21">SUIVANT</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Etape 2</div>
    <div class="step-new-content">
      <div class="row">
       <div class="md-form col-4 ml-auto">
          <!-- Material input -->
           <label >Date de Naissance</label>
          <div class="md-form form-group">
        <!-- Default inline 1-->
          <div class="input-with-post-icon datepicker">
            <input placeholder="Select date" type="date" name="date_naissance" value="{{ old('date_naissance') }}" id="date_naissance" class="form-control"> 
            @error('date_naissance')
           <div class="error">{{ $message }}</div>
          @enderror
          </div> 
          </div>

        </div>

        <div class="md-form col-4 ml-auto">
          <!-- Material input -->
         <div class="md-form form-group">
          <input type="text" name="profession" class="form-control" value="{{ old('profession') }}" id="profession" required>
          <label for="profession">Profession</label>
          @error('profession')
           <div class="error">{{ $message }}</div>
         @enderror 
         </div>

        </div>

        <div class="md-form col-4 ml-auto">
          <!-- Material input -->
         <div class="md-form form-group">
          <input type="text" name="contact" class="form-control" value="{{ old('contact') }}" id="contact" required>
          <label for="contact">Contact</label>
          @error('contact')
           <div class="error">{{ $message }}</div>
         @enderror 
         </div>

        </div>
      </div>
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-info next-step" data-feedback="someFunction21">SUIVANT</button>
        <button class="waves-effect waves-dark btn btn-sm btn-primary previous-step">ANNULER</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Etape 3</div>
    <div class="step-new-content">
      <div class="row">
       

       

       <div class="md-form col-6 ml-auto">
          <!-- Material input -->
         <div class="md-form form-group">
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" required>
          <label for="email">Email</label>
          @error('email')
           <div class="error">{{ $message }}</div>
         @enderror 
         </div>

      </div>

           <div class="col-md-6 mt-5">
      <!-- Material input -->
        <div class="input-group">
           <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroupFileAddon01">Ajouter une photo</span>
           </div>
               <div class="custom-file">
               <input type="file" name="photo" class="custom-file-input" id="photo" aria-describedby="inputGroupFileAddon01">
               <label class="custom-file-label" for="membre">Parcourir...</label>
               </div>
          </div>
            @error('photo')
           <div class="error">{{ $message }}</div>
           @enderror 
        </div>


       </div> 
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-info next-step" data-feedback="someFunction21">SUIVANT</button>
        <button class="waves-effect waves-dark btn btn-sm btn-primary previous-step">ANNULER</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Etape 4</div>
    <div class="step-new-content">
      Terminé!
      <div class="step-actions">
        <a class="waves-effect waves-dark btn-sm btn btn-info" onclick="document.getElementById('form').submit();">Enregistrer</a>
      </div>
    </div>
  </li>
</ul>

</form>
<!-- Extended material form grid -->
 </div> 


  </main>
  <!--Main Layout-->
@stop