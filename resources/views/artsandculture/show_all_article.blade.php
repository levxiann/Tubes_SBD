@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
<nav class="navbar navbar-expand-sm navbar-light" style="border=1;">
    <div class="container-fluid">
        <button class="navbar-brand arrow-back-icon back-page"><i class="fa fa-arrow-left"></i></button>
        <span class="navbar-brand">Telusuri</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mr-auto">
            </div>
        </div>
    </div>
</nav>
<!-- End Navbar Section -->

      <!-- Header Section -->
      <header>
          <div class="d-flex justify-content-start header-title">
              <h4>{{$count}} artikel</h4>
          </div>
      </header>
      <!-- End Header Section -->

      <!-- tab content -->
    <div class="container">
        <div class="row justify-content-start">
            @foreach($articles as $article)
            <div class="col-3">
                <a href="#" style="text-decoration:none">
                    <div class="card border-0" style="width: 10rem; border-radius: 5px;">
                        <img src="{{asset('/images/articles/'. $article->image)}}" class="card-img-top" style="width: 13rem; height: 12rem; object-fit: cover; border-radius: 5px;" alt="...">
                        <div class="card-body">
                            <span class="cerita">CERITA</span><br>
                            <span class="card-title" style="color:black; font-weight:500;">{{$article->title}}</span>
                            <p class="card-text credit">{{$article->credit}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
      <!-- End tab content -->

      
      <!-- End Tab Section -->
@endsection