@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->
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
@error('image')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror
@error('itemmed')
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

<div class="row">
    <div class="col-12 col-md-12 col-xl-12 col-sm-12 text-center">
        <img src="{{asset('images/items/'.$item->image)}}" class="img-fluid" alt="{{$item->title}}" title="{{$item->title}}">
    </div>
</div><hr>
<div class="row mt-2">
    <h6 class="display-6 ms-3">{{$item->title}}</h6>
    <p class="text-muted ms-3">{{$item->author}} {{$item->date}}</p>
    @if (Auth::check())
        @if (Auth::user()->level == "1")
            <div class="d-flex header-title ms-3">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editItemModal">
                    Edit Item
                </button>
                <form action="{{url('/item/'.$item->id.'/'.$idmed)}}" method="POST" class="ms-2 text-photo" onsubmit="return confirm('Anda Yakin?')">
                    @csrf
                    @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary ms-3" data-bs-toggle="modal" data-bs-target="#editItemMediumModal">
                    Edit Medium
                </button>
        @endif
                @if ($liked == 0)
                    <form action="{{url('/account/favourite/item/'.$item->id . '/'. $idmed)}}" method="POST" class="ms-2 text-photo">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-heart" style="background: transparent"></span> Tambah Favorit</button>
                    </form>
                @else
                    <form action="{{url('/account/favourite/item/delete/'.$item->id . '/' . $idmed)}}" method="POST" class="ms-2 text-photo">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-secondary btn-sm"><span class="fa fa-heart" style="background: transparent"></span> Hapus Favorit</button>
                    </form>
                @endif
            </div>
    @endif
</div><hr>
<div class="row mt-3 ms-2">
    <h6 class="display-6">Detail</h6>
    <p><b>Judul: </b>{{$item->title}}</p>
    <p><b>Pembuat: </b>{{$item->author}}</p>
    <p><b>Tanggal Dibuat: </b>{{$item->date}}</p>
    <p><b>Jenis: </b>{{$item->type}}</p>
    <p>
        <b>Medium: </b>
        @php
            $count = $mediums->count();
            $i = 0;
        @endphp
        @foreach ($mediums as $medium)
            @if($i == 0)
                {{$medium->medium->name}}
            @elseif ($i == $count-1)
                , and {{$medium->medium->name}}
            @else
                , {{$medium->medium->name}}
            @endif
            @php
                $i++;
            @endphp
        @endforeach
    </p>
    <p><b>Dimensi Fisik: </b>{{$item->dimension}}</p>
    <p><b>Repositori: </b>{{$item->repository}}</p>
</div><hr>
<div class="tab-content" id="nav-tabContent">
    <h6 class="display-6 ms-3">Dari Media yang Sama</h6>
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="position-relative ms-3">
            <ul class="list-medium-category d-flex justify-content-start">
                @foreach($items as $itm)
                <a class="link-medium-category" href="{{url('/item/'.$itm->item_id.'/'.$itm->medium_id)}}">
                <li class="medium-category" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), url({{asset('/images/items/'. $itm->item->image)}});">
                    <span class="text-photo text-photo-medium">{{$itm->item->title}}</span>
                </li>
                </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/item/'. $item->id . '/' . $idmed) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group mb-3">
                    <label class="label" for="titleItem">Judul Item</label>
                    <input id="titleItem" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Item title" value="{{ $item->title }}" autocomplete="name" autofocus>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="author">Pembuat</label>
                    <input id="author" name="author" type="text" class="form-control @error('author') is-invalid @enderror" placeholder="author" value="{{ $item->author }}" autocomplete="name" autofocus>
                    @error('author')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="date">Tanggal Dibuat</label>
                    <input id="date" name="date" type="text" class="form-control @error('date') is-invalid @enderror" placeholder="date" value="{{ $item->date }}" autocomplete="name" autofocus>
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="type">Jenis</label>
                    <input id="type" name="type" type="text" class="form-control @error('type') is-invalid @enderror" placeholder="type" value="{{ $item->type }}" autocomplete="name" autofocus>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="dimension">Dimensi Fisik</label>
                    <input id="dimension" name="dimension" type="text" class="form-control @error('dimension') is-invalid @enderror" placeholder="dimension" value="{{ $item->dimension }}" autocomplete="name" autofocus>
                    @error('dimension')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="repository">Repositori</label>
                    <input id="repository" name="repository" type="text" class="form-control @error('repository') is-invalid @enderror" placeholder="repository" value="{{ $item->repository }}" autocomplete="name" autofocus>
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
            <button type="submit" name="editItem" class="btn btn-primary">Save</button>
        </div>
            </form>
    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editItemMediumModal" tabindex="-1" aria-labelledby="editItemMediumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editItemMediumModalLabel">Edit Item Medium</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/item/medium/'. $item->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="label" for="itemmed">Item Medium</label>
                    <select id="itemmed" name="itemmed[]" class="form-select" multiple aria-label="multiple select medium">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($allmed as $med)
                            @foreach ($mediums as $medium)
                                @if ($medium->medium_id == $med->id)
                                    <option value="{{$med->id}}" selected>{{$med->name}}</option>
                                    @php
                                        break;
                                    @endphp
                                @elseif($i == $mediums->count()-1)
                                    <option value="{{$med->id}}">{{$med->name}}</option>
                                @else
                                    @php
                                        $i++;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $i = 0;
                            @endphp
                        @endforeach
                    </select>
                    @error('itemmed')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="editItemMedium" class="btn btn-primary">Save</button>
        </div>
            </form>
    </div>
    </div>
</div>

<select name="tes" id="tes" multiple>
    <option value="1" selected>1</option>
    <option value="2">2</option>
    <option value="3" selected>3</option>
</select>
@endsection