@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->
<header>
    <div class="d-flex justify-content-center header-title">
        <h1>Favorit</h1>
    </div>
</header>

    <!-- tab content -->
    @if ($mediums->count() > 0)
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="position-relative ms-3">
                    <h4 class="display-4">{{$mediums->count()}} Media</h4>
                    <ul class="list-medium-category d-flex justify-content-start">
                        @foreach($mediums as $medium)
                        <a class="link-medium-category" href="{{url('/medium/'.$medium->medium->id)}}">
                        <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/mediums/'. $medium->medium->image)}});">
                            <span class="text-photo text-photo-medium">{{$medium->medium->name}}</span>
                            <span class="text-photo text-photo-sum">{{$medium->medium->category_items->count() + $medium->medium->category_articles->count()}} items</span>
                        </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><hr>
    @endif
    @if ($items->count() > 0)
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="position-relative ms-3">
                    <h4 class="display-4">{{$items->count()}} Item</h4>
                    <ul class="list-medium-category d-flex justify-content-start">
                        @foreach($items as $item)
                        <a class="link-medium-category" href="{{url('/item/'.$item->item->id.'/'.$item->item->category_items()->first()->medium_id)}}">
                        <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/items/'. $item->item->image)}});">
                            <span class="text-photo text-photo-medium">{{$item->item->title}}</span>
                        </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><hr>
    @endif
    @if ($articles->count() > 0)
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="position-relative ms-3">
                    <h4 class="display-4">{{$articles->count()}} Artikel</h4>
                    <ul class="list-medium-category d-flex justify-content-start">
                        @foreach($articles as $article)
                        <a class="link-medium-category" href="{{url('/article/'.$article->article->id.'/'.$article->article->category_articles()->first()->medium_id)}}">
                        <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/articles/'. $article->article->image)}});">
                            <span class="text-photo text-photo-medium">{{$article->article->title}}</span>
                        </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><hr>
    @endif
    <!-- End tab content -->

      
    <!-- End Tab Section -->
@endsection