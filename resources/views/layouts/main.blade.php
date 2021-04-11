<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{$title ?? ''}}</title>

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

  <!--link href="{{asset('admin/css/addons-pro/steppers.css')}}" rel="stylesheet"-->
</head>

<body class="fixed-sn light-blue-skin">

  <!--Double navigation-->
  <header>
    <!-- Sidebar navigation -->
    
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav">
      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>
      <!-- Breadcrumb-->
      <div class="breadcrumb-dn mr-auto">
       
      </div>
      <ul class="nav navbar-nav nav-flex-icons ml-auto">
        <!--<li class="nav-item">
          <a class="nav-link"><i class="fa fa-enveloppe"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link"><i class="fa fa-comments-o"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link"><i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span></a>-->
        </li>
        @if (Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            @if(!empty(Auth::user()->avatar->filename))<img class="user-image" src="{{ Auth::user()->avatar->thumb_url }}" width="40" height="40">@endif{{Auth::user()->name}}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{route('user.password')}}">modifier mot de passe</a>
            <a class="dropdown-item" href="{{route('logout')}}">se déconnecter</a>
          </div>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.Navbar -->
  </header>
  <!--/.Double navigation-->
@yield('content')
  <!--Main Layout-->
 <!-- Page Content -->
  <div class="container">

     

  </div>
  <!-- /.container -->

</body>

  
  <!-- SCRIPTS fontawesome 
   
   <script type="text/javascript" src="{{asset('admin/js/fontawesome.min.js')}}"></script>-->
  <!-- JQuery -->
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