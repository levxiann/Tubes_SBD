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
        @error('title')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('author')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('date')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('type')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('dimension')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('repository')
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
                </div><hr>
                <div class="d-flex header-title ms-3">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editMediumModal">
                        Edit Medium
                    </button>
                    <form action="{{url('/medium/'.$mediums->id)}}" method="POST" class="ms-2 text-photo" onsubmit="return confirm('Anda Yakin?')">
                        @csrf
                        @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form><hr>
                </div>
                <div class="row"><br><br></div>
                <div class="row justify-content-start">
                    <div class="col-lg-2 mark">
                        <span>{{$count_article}} artikel</span>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">
                        @if ($count_article > 5)
                            <a href="/article/{{$mediums->id}}" class="show-all-article" style="text-decoration:none">Lihat Semua</a>
                        @endif
                    </div>
                </div>
                <div class="row justify-content-start">
                    @foreach($articles as $article)
                    <div class="col">
                        <a href="#" style="text-decoration:none">
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
                </div><br><br>
                <div class="row justify-content-start">
                    <div class="col-lg-3 mark">
                        <span>Temukan media ini</span>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#TambahItemModal">
                            Tambah Item
                        </button>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">
                        @if ($count_item > 12)
                            <a href="/item/{{$mediums->id}}" class="show-all-article" style="text-decoration:none">Lihat Semua</a>
                        @endif
                    </div>
                    <p style="color:grey;">{{$count_item}} item</p>
                </div>
                <div class="row">
                    @foreach($items as $item)
                    <div class="col">
                        <a href="{{url('/item/'.$item->item_id.'/'.$item->medium_id)}}" style="text-decoration:none">
                            <img src="{{asset('/images/items/'. $item->item->image)}}" class="item_decor" alt="{{$item->item->title}}" title="{{$item->item->title}}">
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
                    @foreach($media as $med)
                    <div class="col">
                    
                    <a class="link-medium-category" href="/medium/{{$med->id}}">
                    <li class="other-medium-list" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/mediums/'. $med->image)}});">
                        <span class="text-photo photo-text-title">{{$med->name}}</span> <br>
                        <span class="text-photo photo-text-desc">{{$med->category_items->count() + $med->category_articles->count()}} items</span>
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

      <!-- Modal -->
<div class="modal fade" id="editMediumModal" tabindex="-1" aria-labelledby="editMediumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editMediumModalLabel">Edit Medium</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/medium/'.$mediums->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group mb-3">
                    <label class="label" for="name">Medium Name</label>
                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Medium Name" value="{{ $mediums->name }}" autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="desc">Description</label>
                    <textarea id="desc" name="desc" type="text" rows="8" class="form-control @error('desc') is-invalid @enderror" placeholder="description" autocomplete="name" autofocus>{{$mediums->desc }}</textarea>
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
            <button type="submit" name="editMedium" class="btn btn-primary">Save</button>
        </div>
            </form>
    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="TambahItemModal" tabindex="-1" aria-labelledby="TambahItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="TambahItemModalLabel">Tambah Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/item/add/'.$mediums->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label class="label" for="title">Judul Item</label>
                    <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Item title" value="{{ old('title') }}" autocomplete="name" autofocus>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="author">Pembuat</label>
                    <input id="author" name="author" type="text" class="form-control @error('author') is-invalid @enderror" placeholder="author" value="{{ old('author') }}" autocomplete="name" autofocus>
                    @error('author')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="date">Tanggal Dibuat</label>
                    <input id="date" name="date" type="text" class="form-control @error('date') is-invalid @enderror" placeholder="date" value="{{ old('date') }}" autocomplete="name" autofocus>
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="type">Jenis</label>
                    <input id="type" name="type" type="text" class="form-control @error('type') is-invalid @enderror" placeholder="type" value="{{ old('type') }}" autocomplete="name" autofocus>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="dimension">Dimensi Fisik</label>
                    <input id="dimension" name="dimension" type="text" class="form-control @error('dimension') is-invalid @enderror" placeholder="dimension" value="{{ old('dimension') }}" autocomplete="name" autofocus>
                    @error('dimension')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="repository">Repositori</label>
                    <input id="repository" name="repository" type="text" class="form-control @error('repository') is-invalid @enderror" placeholder="repository" value="{{ old('repository') }}" autocomplete="name" autofocus>
                    @error('repository')
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
            <button type="submit" name="TambahItem" class="btn btn-primary">Save</button>
        </div>
            </form>
    </div>
    </div>
</div>
@endsection