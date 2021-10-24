<nav class="navbar navbar-expand-sm navbar-light">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-light" style="border=1;">
        <div class="container-fluid">
            <button class="navbar-brand arrow-back-icon back-page"><i class="fa fa-arrow-left"></i></button>
            <span class="navbar-brand">Kembali</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                </div>
            </div>
        </div>
</nav>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                @if (Auth::check())
                    @if (Auth::user()->level == '1')
                        <a href="{{url('/accounts')}}" class="nav-link me-3">Accounts</a>
                    @endif
                <a href="{{url('/account/favourite')}}" class="nav-link me-3">Favorit</a>
                @endif
                <form class="d-flex" action="{{url('/search')}}" method="GET">
                    <input id="keyword" class="form-control me-2 mb-2 mr-2" type="search" placeholder="Search" name="keyword" aria-label="Search">
                    <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
                </form>
                @if (Auth::check())
                <a class="nav-link" href="{{url('/account')}}" role="button" tabindex="0" aria-expanded="false">
                    <img class="account-photos" src="{{asset('/images/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}" height="40" width="40" aria-hidden="true" data-noaft="">
                </a>
                <a href="{{route('logout')}}" class="btn btn-danger ms-2"> Sign Out</a>
                @else
                <a href="{{url('/login')}}" class="btn btn-primary ms-2"> Sign In</a>
                @endif
            </div>
        </div>
    </div>
</nav>