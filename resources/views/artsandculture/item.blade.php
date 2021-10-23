@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

      <!-- Header Section -->
      <header>
          <div class="d-flex justify-content-start header-title">
              <h4>{{$items->count()}} item</h4>
          </div>
      </header>
      <!-- End Header Section -->

    <!-- tab content -->
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="position-relative ms-3">
                <ul class="list-medium-category d-flex justify-content-start">
                    @foreach($items as $item)
                    <a class="link-medium-category" href="{{url('/item/'.$item->item_id.'/'.$item->medium_id)}}">
                    <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/items/'. $item->item->image)}});">
                        <span class="text-photo text-photo-medium">{{$item->item->title}}</span>
                        <form action="{{url('/item/'.$item->item_id)}}" method="POST" class="mt-2 ms-2 text-photo" onsubmit="return confirm('Anda Yakin?')">
                            @csrf
                            @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
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