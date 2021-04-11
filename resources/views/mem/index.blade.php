@extends('layouts.main3')

 @section('content')
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    @include('includes.sidebar3')
    <!-- /.Navbar -->

  <!--/.Double navigation-->

  <!--Main Layout-->
  <main>
   

 <div id="card" class="card col-md-12">
<div>
@foreach($dept as $depts)
  <label id="dept">{{$depts}}</label>
@endforeach
</div>
 
<div align="center"><h3 class="text-muted font-weight-bold mt-5"><u><b>TABLEAU DE BORD</b></u></h3>
    
 <!-- Extended material form grid -->

      @if(session('success'))

           <div class="alert alert-success">{{ session('success') }}</div>

       @endif

     </div>
   <!-- Grid row -->
  <div class="row mt-5">

       <div class="col-xl-4 col-md-8 mb-xl-0 mb-4">

            <!-- Card -->
            <div id="text" class="card card-cascade cascading-admin-card">
            
            <img id="far" src="{{url(asset('admin/img/statistique2.jpg'))}}" alt="" class="img-fluid z-depth-3 responsive-img left" style="padding-right: 0%; width:30%;">

            <!--<i id="far" src="{{asset('admin/img/statistique2.jpg')}}" class="mr-3 z-depth-2"></i>-->

            
              <!-- Card Data -->
              <h4 id="data" class="font-weight-bold dark-grey-text mt 1">{{$comp}}</h4>

 
              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div align="center"><p id="nb" class="card-text font-weight-bold">TOTAL</p></div>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <div class="col-xl-4 col-md-8 mb-xl-0 mb-4">

            <!-- Card -->
            <div id="text" class="card card-cascade cascading-admin-card">

            <img id="far" src="{{url(asset('admin/img/statistique2.jpg'))}}" alt="" class="img-fluid z-depth-3 responsive-img left" style="padding-right: 0%; width:30%;">
              <!-- Card Data -->
              <h4 id="data" class="font-weight-bold dark-grey-text">{{$comp_h}}</h4>

 
              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div align="center"><p id="nb" class="card-text font-weight-bold">Hommes ({{$pourh}}%)</p></div>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <div class="col-xl-4 col-md-8 mb-xl-0 mb-4">

            <!-- Card -->
            <div id="text" class="card card-cascade cascading-admin-card">

            <img id="far" src="{{url(asset('admin/img/statistique2.jpg'))}}" alt="" class="img-fluid z-depth-3 responsive-img left" style="padding-right: 0%; width:30%;">
              <!-- Card Data -->
              <h4 id="data" class="font-weight-bold dark-grey-text">{{$comp_f}}</h4>

 
              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div align="center"><p id="nb" class="card-text font-weight-bold">Femmes ({{$pourf}}%)</p></div>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->
    </div>

<!-- Extended material form grid -->
 </div> 



  </main>
  <!--Main Layout-->
@stop