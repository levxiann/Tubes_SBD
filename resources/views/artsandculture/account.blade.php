@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

@error('name')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror
@error('sex')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror
@error('birthOfDate')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror
@error('email')
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

      <!-- tab content -->
    <div class="container">
        <div class="row justify-content-start">
            <div class="d-flex justify-content-start header-title">
                <h4>My Account</h4>
            </div>
                    <table class="table">
                        <tbody>
                            <tr>
                            <td scope="row" rowspan="4"><img src="{{asset('images/'.Auth::user()->image)}}" alt="Bio" height="300" width="200" class="rounded float-start"></td>
                            <th>Nama</th>
                            <td>{{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                            <th>Jenis Kelamin</th>
                            <td>
                                @if (Auth::user()->sex == 'P')
                                    Perempuan
                                @else
                                    Laki - Laki
                                @endif
                            </td>
                            </tr>
                            <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{date("d M Y",strtotime(Auth::user()->birthOfDate))}}</td>
                            </tr>
                            <tr>
                            <th>Email</th>
                            <td>{{Auth::user()->email}}</td>
                            </tr>
                        </tbody>
                    </table>
        </div>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editAkunModal">
            Edit Akun
        </button>
    </div>
      <!-- End tab content -->

      
      <!-- End Tab Section -->
<!-- Modal -->
<div class="modal fade" id="editAkunModal" tabindex="-1" aria-labelledby="editAkunModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editAkunModalLabel">Edit Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/account') }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group mb-3">
                    <label class="label" for="name">Nama</label>
                    <input id="name" name="name" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ Auth::user()->name }}" autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="perempuan">Jenis Kelamin</label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" value="P" type="radio" name="sex" id="perempuan" {{Auth::user()->sex == "P" ? "checked" : ""}}>
                            <label class="form-check-label" for="perempuan">
                              Perempuan
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" value="L" type="radio" name="sex" id="lakilaki" {{Auth::user()->sex == "L" ? "checked" : ""}}>
                            <label class="form-check-label" for="lakilaki">
                              Laki - Laki
                            </label>
                        </div>
                    </div>
                    @error('sex')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="birthOfDate">Tanggal Lahir</label>
                    <input id="birthOfDate" type="date" class="form-control @error('birthOfDate') is-invalid @enderror" name="birthOfDate" value="{{ Auth::user()->birthOfDate }}" autocomplete="name" autofocus>
                    @error('birthOfDate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="email">E-mail</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{ Auth::user()->email }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="image">Gambar</label>
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
            <button type="submit" name="editAkun" class="btn btn-primary">Save</button>
        </div>
            </form>
    </div>
    </div>
</div>
@endsection
