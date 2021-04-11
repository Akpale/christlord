<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>{{$title ?? ''}}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Font Awesome CSS -->
  <link href="{{asset('admin/css/all.css')}}" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('admin/css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin/css/fontawesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  
  <!-- Material Design Bootstrap -->
  <link href="{{asset('admin/css/mdb.min.css')}}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

  <link href="{{asset('admin/css/addons-pro/steppers.min.css')}}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
<link href="{{asset('css/signin.css')}}" rel="stylesheet"> 


    
  </head>
  <body class="text-center">
    
<main class="form-signin">
  @if(session('success'))

           <div class="alert alert-success">{{ session('success') }}</div>

       @endif

       @if(session('error'))

           <div class="alert alert-danger">{{ session('error') }}</div>

       @endif
<section class="form-elegant">
  <form action="{{route('post.login')}}" method="post">
    @csrf
    
    

  <!--Form without header-->
  <div class="card">

    <div class="card-body mx-5">

      <!--Header-->
      <div class="text-center">
        <h3 class="dark-grey-text mb-5"><strong>CHRIST LORD</strong></h3>
      </div>

      <!--Body-->
      <div class="md-form">
        <input type="text" id="pseudo" name="pseudo" class="form-control" value="{{ old('pseudo') }}">
             @error('pseudo')
           <div class="error">{{ $message }}</div>
             @enderror 
        <label for="pseudo">Pseudo</label>
      </div>

      <div class="md-form pb-3">
        <input type="password" id="password" name="password" class="form-control mt-3">
             @error('password')
           <div class="error">{{ $message }}</div>
             @enderror 
        <label for="password">Mot de Passe</label>
      </div>
         <!-- Se souvenir -->
          <div class="form-check mb-4">
            <input type="checkbox" class="form-check-input"  id="remember" name="remember" value="1">
            <label class="form-check-label" for="remember">Se Souvenir</label>
          </div>

      
  
      <div class="text-center mb-3">
        <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Se Connecter</button>
      </div>
      
      <!--Footer-->
    <div class="modal-footer mx-4 pt-3 mb-1">
      <p class="mt-5 text-muted">&copy; Copyright 2021 V.2.0</p>
    </div>

    </div>

    

  </div>
  <!--/Form without header-->


  </form>
</section>
     


</main>


    
  </body>

   <script type="text/javascript" src="{{asset('admin/js/all.js')}}"></script>

  <script type="text/javascript" src="{{asset('admin/js/jquery-3.4.1.min.js')}}"></script>
  <!-- Bootstrap tooltips -->
  <script type="javascript" src="{{asset('admin/js/popper.min.js')}}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{asset('admin/js/bootstrap.js')}}"></script>

  <!--<script type="text/javascript" src="{{asset('admin/js/bootstrap.min.js')}}"></script>-->
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{asset('admin/js/mdb.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('admin/js/dataTables.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
  
  

  <!-- SCRIPTS -->
  <script type="text/javascript" src="{{asset('admin/js/script.js')}}"></script>
 
 

  <script type="text/javascript" src="{{asset('admin/js/addons-pro/steppers.min.js')}}"></script>
</html>
