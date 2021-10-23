@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

      <!-- Header Section -->
      <header>
        <div class="image">
            <img src="{{asset('/images/mediums/'. $mediums->image)}}" alt="">
        </div>
          <div class="d-flex justify-content-center header-title">
              <p>{{$mediums->name}}</p>
          </div>
      </header>
      <!-- End Header Section -->

      <!-- tab content -->
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 col-12">
                        @if(strlen($mediums->desc)>280)
                        <span class="dots"><p>{{substr($mediums->desc,0,285)}}...</p></span>
                        <button class="read-more-show">Baca lebih banyak</button>
                        <span class="read-more-content hide-content"><p>{{$mediums->desc}}</p></span>
                        <button class="read-more-hide hide-content">Tampilkan lebih sedikit</button>
                        @else
                        {{$mediums->desc}}
                        @endif
                    </div>
                </div>
                <div class="row"><br><br></div>
                <div class="row justify-content-start">
                    <div class="col-lg-2 mark">
                        <span>{{$count}} artikel</span>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">
                        <a href="/medium/show_all_article/{{$mediums->id}}" class="show-all-article" style="text-decoration:none">Lihat Semua</a>
                    </div>
                    
                    
                    <!--@if($count>5)-->
                    
                    <!--@endif-->
                </div>
                <div class="row justify-content-start">
                    @foreach($articles as $article)
                    <div class="col">
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
                </div><br><br>
                <div class="row justify-content-start">
                    <div class="col-lg-3 mark">
                        <span>Temukan media ini</span>
                    </div>
                    <p style="color:grey;">{{$count_item}} item</p>
                </div>
                <div class="row">
                    @foreach($items as $item)
                    <div class="col">
                        <a href="#" style="text-decoration:none">
                            <img src="{{asset('/images/items/'. $item->image)}}" class="item_decor" alt="...">
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="row"><br><br></div>
                <div class="row justify-content-start">
                    <div class="col-lg-3 mark">
                        <span>Media lainnya</span>
                    </div>
                </div>
                <div class="row justify-content-start">
                    @foreach($media as $medium)
                    <div class="col">
                    
                    <a class="link-medium-category" href="/medium/{{$medium->id}}">
                    <li class="other-medium-list" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/mediums/'. $medium->image)}});">
                        <span class="text-photo photo-text-title">{{$medium->name}}</span> <br>
                        <span class="text-photo photo-text-desc">{{$medium->category_items->count() + $medium->category_articles->count()}} items</span>
                    </li>
                    </a>
                    
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
      <!-- End tab content -->

      
      <!-- End Tab Section -->
@endsection