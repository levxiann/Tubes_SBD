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

      <!-- tab content -->
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="position-relative">
              <ul class="list-medium-category d-flex justify-content-center">
                  @foreach($mediums as $medium)
                  <a class="link-medium-category" href="/medium/{{$medium->id}}">
                  <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/mediums/'. $medium->image)}});">
                      <span class="text-photo text-photo-medium">{{$medium->name}}</span>
                      <span class="text-photo text-photo-sum">{{$medium->category_items->count() + $medium->category_articles->count()}} items</span>
                  </li>
                  </a>
                  @endforeach
              </ul>
          </div>
        </div>
      </div>
      <!-- End tab content -->

      
      <!-- End Tab Section -->
@endsection