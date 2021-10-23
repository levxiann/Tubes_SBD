@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

      <!-- Header Section -->
      <header>
        @error('name')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('desc')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('image')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
          <div class="d-flex header-title">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahMediaModal">
                Tambah Media
            </button>
          </div>
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
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Medium Name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="desc">Description</label>
                        <textarea id="desc" name="desc" type="text" rows="8" class="form-control @error('desc') is-invalid @enderror" placeholder="description" autocomplete="name" autofocus>{{old('desc')}}</textarea>
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
@endsection