@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

@error('articlemed')
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

<div class="row mt-2 mb-2">
    <div class="d-flex header-title ms-3">
        @if (Auth::check())
            @if (Auth::user()->level == "1")
                <a href="{{url('/article/edit/'.$articles->id.'/'.$idmed)}}" class="btn btn-warning">Edit Artikel</a>
                <form action="{{url('/article/'.$articles->id.'/'.$idmed)}}" method="POST" class="ms-2 text-photo" onsubmit="return confirm('Anda Yakin?')">
                    @csrf
                    @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary ms-3" data-bs-toggle="modal" data-bs-target="#editArticleMediumModal">
                    Edit Medium
                </button>
            @endif
                @if ($liked == 0)
                    <form action="{{url('/account/favourite/article/'.$articles->id . '/'. $idmed)}}" method="POST" class="ms-2 text-photo">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-heart" style="background: transparent"></span> Tambah Favorit</button>
                    </form>
                @else
                    <form action="{{url('/account/favourite/article/delete/'.$articles->id . '/' . $idmed)}}" method="POST" class="ms-2 text-photo">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-secondary btn-sm"><span class="fa fa-heart" style="background: transparent"></span> Hapus Favorit</button>
                    </form>
                @endif
        @endif
    </div>
</div>

<div class="background" id="title" style="background-image: url({{asset('/images/articles/'. $articles->image)}});">
  <div id="text">
    <p><span style="font-size: 40px; background: transparent">{{$articles->title}}</span></p>
    <hr><p><span style="font-size: 20px; background: transparent">Oleh {{$articles->writer}}</span></p>
  </div>
</div>
<div class="background" id="content">
  <a>{!! html_entity_decode($articles->content) !!}</a>
</div>
<div class="footer">
  <hr>
  <p><span style="font-size: 30px">Kredit: {{$articles->credit}}</span></p>
  <p><span style="font-size: 15px">Text: {{$articles->writer}}</span></p>
</div>

<!-- Modal -->
<div class="modal fade" id="editArticleMediumModal" tabindex="-1" aria-labelledby="editArticleMediumModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="editArticleMediumModalLabel">Edit Article Medium</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{ url('/articles/medium/'. $articles->id) }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                  <label class="label" for="articlemed">Artikel Medium</label>
                  <select id="articlemed" name="articlemed[]" class="form-select" multiple aria-label="multiple select medium">
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
          <button type="submit" name="editArticleMedium" class="btn btn-primary">Save</button>
      </div>
          </form>
  </div>
  </div>
</div>
@endsection