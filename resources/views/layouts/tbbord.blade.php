 @extends('layouts.main')

@section('content')

<section class="mt-md-4 pt-md-2 mb-5 pb-4">

        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">

              <!-- Card Data -->
              <div class="admin-up">
                <i class="far fa-money-bill-alt primary-color mr-3 z-depth-2"></i>
                <div class="data">
                  <p class="text-uppercase">sales</p>
                  <h4 class="font-weight-bold dark-grey-text">2000$</h4>
                </div>
              </div>

              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="card-text">Better than last week (25%)</p>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">

              <!-- Card Data -->
              <div class="admin-up">
                <i class="fas fa-chart-line warning-color mr-3 z-depth-2"></i>
                <div class="data">
                  <p class="text-uppercase">subscriptions</p>
                  <h4 class="font-weight-bold dark-grey-text">200</h4>
                </div>
              </div>

              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar red accent-2" role="progressbar" style="width: 25%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="card-text">Worse than last week (25%)</p>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-xl-3 col-md-6 mb-md-0 mb-4">

            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">

              <!-- Card Data -->
              <div class="admin-up">
                <i class="fas fa-chart-pie light-blue lighten-1 mr-3 z-depth-2"></i>
                <div class="data">
                  <p class="text-uppercase">traffic</p>
                  <h4 class="font-weight-bold dark-grey-text">20000</h4>
                </div>
              </div>

              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar red accent-2" role="progressbar" style="width: 75%" aria-valuenow="75"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="card-text">Worse than last week (75%)</p>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-xl-3 col-md-6 mb-0">

            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">

              <!-- Card Data -->
              <div class="admin-up">
                <i class="fas fa-chart-bar red accent-2 mr-3 z-depth-2"></i>
                <div class="data">
                  <p class="text-uppercase">organic traffic</p>
                  <h4 class="font-weight-bold dark-grey-text">2000</h4>
                </div>
              </div>

              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="card-text">Better than last week (25%)</p>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: Intro -->
    
@stop