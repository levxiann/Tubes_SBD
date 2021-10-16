@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

      <!-- Header Section -->
      <header>
          <div class="d-flex justify-content-center header-title">
              <h1>Media</h1>
          </div>
      </header>
      <!-- End Header Section -->

      <!-- Tabs Section -->
      <nav class="d-flex justify-content-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Semua</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">A-Z</button>
        </div>
      </nav>
      <!-- tab content -->
      <div class="tab-content" id="nav-tabContent">
        @include('artsandculture.layouts.tab_all')

        @include('artsandculture.layouts.tab_a-z')
      </div>
      <!-- End tab content -->

      
      <!-- End Tab Section -->
@endsection