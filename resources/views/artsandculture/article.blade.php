@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

      <!-- Header Section -->
      <header>
          <div class="d-flex justify-content-start header-title">
              <h4>{{$articles->count()}} artikel</h4>
          </div>
      </header>
      <!-- End Header Section -->

      <!-- tab content -->
    <div class="container">
        <div class="row justify-content-start">
            @foreach($articles as $article)
            <div class="col-3">
                <a href="{{url('/article/'.$article->article_id.'/'.$article->medium_id)}}" style="text-decoration:none">
                    <div class="card border-0" style="width: 10rem; border-radius: 5px;">
                        <img src="{{asset('/images/articles/'. $article->article->image)}}" class="card-img-top" style="width: 13rem; height: 12rem; object-fit: cover; border-radius: 5px;" alt="...">
                        <div class="card-body">
                            <span class="cerita">CERITA</span><br>
                            <span class="card-title" style="color:black; font-weight:500;">{{$article->article->title}}</span>
                            <p class="card-text credit">{{$article->article->credit}}</p>
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
