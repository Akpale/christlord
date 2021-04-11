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
     
 <!-- Extended material form grid -->

      @if(session('success'))

           <div class="alert alert-success">{{ session('success') }}</div>

       @endif

     </div>

   


 <div class="card card-outline-secondary my-4">
          <div class="card-header">
            {{$description ?? ''}}
          </div>
          <div class="card-body">
                 <form action="{{route('groupes.update',$fichier->id)}}" method="post" enctype="multipart/form-data">
                    

                    @method('PUT')
                     @csrf

                  <div class="form-group">
                        <label for="date_activite" >Date d'activité</label>
                        <input type="date" name="date_activite" class="form-control" value="{{ old('date_activite',$fichier->date_activite) }}" >

                        @error('date_activite')
                             <div class="error">{{ $message }}</div>
                        @enderror 
                  </div>  

                  <!-- Material input -->
                  
        
                  
                  <div class="form-group">
                    <label for="content" >Description</label>
                    <textarea class="form-control" name="description" cols="30" rows="5" placeholder="Insérer une description">{{ old('description',$fichier->description)}}</textarea>

                    @error('description')
                         <div class="error">{{ $message }}</div>
                    @enderror 
                  </div>  

                  <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text" id="inputGroupFileAddon01">Ajouter une pièce jointe</span>
                     </div>
                         <div class="custom-file">
                         <input type="file" name="fichier" class="custom-file-input" id="fichier" aria-describedby="inputGroupFileAddon01">
                         <label class="custom-file-label" for="membre">Parcourir...</label>
                         </div>
                    </div>
                      @error('fichier')
                     <div class="error">{{ $message }}</div>
                     @enderror 
                  
                  <button type="submit" class="btn btn-info">Ajouter</button>
                </form>
                
          </div>
        </div>
<!-- Extended material form grid -->
 </div> 
<!-- Extended material form grid -->
 </div> 


  </main>
  <!--Main Layout-->
@stop