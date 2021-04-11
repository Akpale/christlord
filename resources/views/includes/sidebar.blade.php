<div id="slide-out" class="side-nav sn-bg-4 fixed">
      <div align="center" id="cl" class="mt-3"><span id="tcl">CHRIST LORD</span></div>
      <ul class="custom-scrollbar">
        <!-- Logo -->
        <!--<a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
        </button>
        
        <li>
            <div class="pull-left image" id="user" align="left">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @if(!empty(Auth::user()->avatar->filename))<img class="img-circle" src="{{ Auth::user()->avatar->thumb_url }}" width="40" height="40">@endif       <b>{{Auth::user()->name}}</b>
            </a>
            </div>
            <!--a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="img-fluid flex-center"></a-->
        </li>

        <!--/.Search Form-->
        <!-- Side navigation links -->
        <li>
          <ul class="collapsible collapsible-accordion mt-0">
            <li><a class="text-white bg mt-2" href="{{route('users.index')}}" class="collapsible-header waves-effect arrow-r">
            <i class="fas fa-tachometer-alt" ></i> <span id="menu">Tableau de Bord</span>
            <li><a href="#" class="collapsible-header waves-effect arrow-r"><i class="fas fa-cogs"></i> <span id="menu"> Paramètres</span><i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="{{route('departement.show')}}" class="waves-effect"><span>Département</span></a>
                  </li>
                </ul>
              </div>
            </li>
            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-users"></i>
                <span id="menu">Compte utilisateur</span><i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="{{route('users.create')}}" class="waves-effect">Ajouter</a>
                  </li>
                  <li><a href="{{route('user.show')}}" class="waves-effect">Mise à jour</a>
                  </li>
                </ul>
              </div>
            </li>
            <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-question-circle"></i><span id="menu"> Aide </span></a>
            <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-copyright"></i> <span id="menu">A propos de ChristLord </span><i></i></a>
            </li>
          </ul>
        </li>
        <!--/. Side navigation links -->
      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>