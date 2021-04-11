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

      <div align="center"><h2 class="text-muted"><u><b>Programmes par Département</b></u></h2></div> 

      @if(session('success'))

           <div class="alert alert-success" align="center">{{ session('success') }}</div>

       @endif

     <form action="{{route('programme')}}" method="POST" >
       <div class="row justify-content-center mt-5">    
        <!--/Blue select-->

           @csrf
            
             
            <div class="col-md-2 mt-5" align="right">
               
                  <label >Période du:</label>

             </div>

            <div class="col-md-2">
             <!-- Material input -->
              
               <!-- Default inline 1-->
                <div class="input-with-post-icon datepicker mt-0">
                  <label></label>
                <input placeholder="Select date" type="date" name="dateactivite1"  class="form-control"> 
                  
                 </div>

             </div>

             <div class="mt-5" align="center">
               
                  <label >Au:</label>

              </div>

             <div class="col-md-2">
            
                <div class="input-with-post-icon datepicker mt-4">
                  
                   <input placeholder="Select date" type="date" name="dateactivite2" class="form-control"> 
                  
                 </div>

             </div>

             <div class="col-md-2">

                 <select class="mdb-select md-form colorful-select dropdown" name="departement_id" id="departement_id"> <!--onChange="submit()"-->

                 <option value="">Sélectionner...</option>  
                   @foreach($departement as $departements)
         
                <option value="{{ $departements->id }}"> {{$departements->libelle}}</option> 

                 <!--?php if (isset($_POST['champListe']) && $_POST['champListe']== "client"){echo "selected";} ?-->

                     @endforeach   
                  </select>
                    
                 <label class="mdb-main-label text-muted"><h6>Département</h6></label>

            </div>

            

             <div class="col-md-3">
                 <button type="submit" class="btn btn-info"><i class="fas fa-search"></i>rechercher</button>
            </div>

        </div>

            

      </form>
    

       <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Date
      </th>
      <th class="th-sm">Description de l'activité
      </th>
      <th class="th-sm">Fichier
      </th>
      <th class="th-sm">Télécharger
      </th>
     
    </tr>
  </thead>
  <tbody>
    @foreach($fichiers as $fichier)
    <tr>
      <td>{{date('d-m-Y',strtotime($fichier->date_activite))}}</td>
      <td>{{$fichier->description}}</td>
      <td>{{$fichier->filename}}</td>
      <td><a  href="{{$fichier->url}}" download="{{$fichier->filename}}"><h6 style="color:#0099CC;">Télécharger</h6></a></td>
      
    </tr>
    @endforeach
  </tbody>
</table>
      <br>
    </div>
 </div>

  <!--Main Layout-->
@stop