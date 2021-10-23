@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

    <!-- tab content -->
    @if ($mediums->count() > 0)
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="position-relative ms-3">
                    <h4 class="display-4">{{$mediums->count()}} Media</h4>
                    <ul class="list-medium-category d-flex justify-content-start">
                        @foreach($mediums as $medium)
                        <a class="link-medium-category" href="#">
                        <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/mediums/'. $medium->image)}});">
                            <span class="text-photo text-photo-medium">{{$medium->name}}</span>
                            <span class="text-photo text-photo-sum">{{$medium->category_items->count() + $medium->category_articles->count()}} items</span>
                            <form action="{{url('/medium/'.$medium->id)}}" method="POST" class="mt-2 ms-2 text-photo" onsubmit="return confirm('Anda Yakin?')">
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
        </div><hr>
    @endif
    @if ($items->count() > 0)
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="position-relative ms-3">
                    <h4 class="display-4">{{$items->count()}} Item</h4>
                    <ul class="list-medium-category d-flex justify-content-start">
                        @foreach($items as $item)
                        <a class="link-medium-category" href="{{url('/item/'.$item->id.'/'.$item->category_items()->first()->medium_id)}}">
                        <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/items/'. $item->image)}});">
                            <span class="text-photo text-photo-medium">{{$item->title}}</span>
                            <form action="{{url('/item/'.$item->id)}}" method="POST" class="mt-2 ms-2 text-photo" onsubmit="return confirm('Anda Yakin?')">
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
        </div><hr>
    @endif
    @if ($articles->count() > 0)
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="position-relative ms-3">
                    <h4 class="display-4">{{$articles->count()}} Artikel</h4>
                    <ul class="list-medium-category d-flex justify-content-start">
                        @foreach($articles as $article)
                        <a class="link-medium-category" href="{{url('/article/'.$article->id.'/'.$article->category_articles()->first()->medium_id)}}">
                        <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/articles/'. $article->image)}});">
                            <span class="text-photo text-photo-medium">{{$article->title}}</span>
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
    
    <!-- Modal -->
    <div class="modal fade" id="tambahMediaModal" tabindex="-1" aria-labelledby="tambahMediaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="tambahMediaModalLabel">Tambah Media</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/medium/add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="label" for="name">Medium Name</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Stock Name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="desc">Description</label>
                        <textarea id="desc" name="desc" type="text" rows="8" class="form-control @error('desc') is-invalid @enderror" placeholder="desc" autocomplete="name" autofocus>{{old('desc')}}</textarea>
                        @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="image">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addMedium" class="btn btn-primary">Save</button>
            </div>
                </form>
        </div>
        </div>
    </div>

    <script>

    </script>
@endsection