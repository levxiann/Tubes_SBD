@extends('artsandculture.layouts.main')

@section('main')

<!-- Navbar Section -->
    @include('artsandculture.layouts.navbar')
<!-- End Navbar Section -->

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

      <!-- tab content -->
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-12 d-flex justify-content-start header-title">
                <h4>Accounts</h4>
            </div>
            <form class="d-flex" action="{{url('/accounts/search')}}" method="GET">
                <input id="keyword" class="form-control me-2 mb-2 mr-2" type="search" placeholder="Search Account" name="keyword" aria-label="Search">
                <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
            </form>
            @foreach ($users as $user)
                <div class="col-3 card mb-3 me-2" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset('/images/'.$user->image)}}" class="img-fluid rounded-start" alt="{{$user->name}}">
                            @if ($user->id != Auth::user()->id)
                                <form action="{{url('/accounts/'.$user->id)}}" method="POST" class="ms-2 text-photo" onsubmit="return confirm('Anda Yakin?')">
                                    @csrf
                                    @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$user->name}}</h5>
                                <p class="card-text">
                                    @if ($user->sex = 'P')
                                        Perempuan        
                                    @else
                                        Laki - Laki
                                    @endif
                                    {{date("d M Y", strtotime($user->birthOfDate))}}</p>
                                <p class="card-text">{{$user->email}}</p>       
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row mt-2 ml-2">
                {{$users->onEachSide(2)->links()}}
            </div>
        </div>
    </div>
      <!-- End tab content -->
@endsection