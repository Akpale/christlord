 @extends('layouts.main')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>
 
     <h3 class="text-muted">Créer un utilisateur</h3>
    
 <!-- Extended material form grid -->


<form>
  @csrf
  <!-- Grid row -->
  <div class="form-row">
    <!-- Grid column -->
    <div class="col-md-6">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="text" class="form-control" id="pseudo" >
        <label for="pseudo">Pseudo</label>
      </div>
    </div>
    <!-- Grid column -->

     <!-- Grid column -->
    <div class="col-md-6">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="text" class="form-control" id="nom" >
        <label for="nom">Nom</label>
      </div>
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-6">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="email" class="form-control" id="inputEmail4MD" >
        <label for="inputEmail4MD">Email</label>
      </div>
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-6">
      <!-- Material input -->
      <div class="md-form form-group">
        <input type="password" class="form-control" id="inputPassword4MD" >
        <label for="inputPassword4MD">Mot de Passe</label>
      </div>
    </div>
    <!-- Grid column -->
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="row">
    <!-- Grid column -->
    <div class="col-md-6">
      <!-- Material input -->
      <!--Blue select-->
       <!--Blue select-->
      <select class="mdb-select md-form colorful-select dropdown">
        <option value="1">Administrateur</option>
        <option value="2">Sécretariat</option>
        <option value="3">Utitisateur</option>
      </select>
      <label class="mdb-main-label text-muted"><h6>Profil</h6></label>

    </div>
    <!-- Grid column -->
<!--/Blue select-->
<div class="col-md-6">
     <select class="mdb-select md-form colorful-select dropdown">
        <option value="1">Néhémie</option>
        <option value="2">AOC</option>
        <option value="3">Jeunesse</option>
      </select>
      <label class="mdb-main-label text-muted"><h6>Département</h6></label>
</div>
<!--/Blue select-->

    <!-- Grid column -->
    <div class="col-md-8">
      <!-- Material input -->
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Ajouter une photo</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Parcourir...</label>
  </div>
</div>
    </div>
    <!-- Grid column -->
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="col-md-5">
    
    <button type="submit" class="btn btn-default mt-5">Enregistrer</button>
    
  </div>
  <!-- Grid row -->
  
</form>
<!-- Extended material form grid -->
  </main>
  <!--Main Layout-->
@stop