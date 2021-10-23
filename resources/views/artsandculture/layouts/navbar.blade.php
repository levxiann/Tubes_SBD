<nav class="navbar navbar-expand-sm navbar-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a href="#" class="nav-link me-3">Favorit</a>
                <form class="d-flex" action="{{url('/search')}}" method="GET">
                    <input id="keyword" class="form-control me-2 mb-2 mr-2" type="search" placeholder="Search" name="keyword" aria-label="Search">
                    <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
                </form>
                <a class="nav-link" href="#" role="button" tabindex="0" aria-expanded="false">
                <img class="account-photos" src="https://lh3.google.com/u/0/ogw/ADea4I7w4GqYPqBxAPfKjtBY8mhgUCNSaHFSmLhrvTGS=s32-c-mo" srcset="https://lh3.google.com/u/0/ogw/ADea4I7w4GqYPqBxAPfKjtBY8mhgUCNSaHFSmLhrvTGS=s32-c-mo 1x, https://lh3.google.com/u/0/ogw/ADea4I7w4GqYPqBxAPfKjtBY8mhgUCNSaHFSmLhrvTGS=s64-c-mo 2x " alt="" aria-hidden="true" data-noaft="">
                </a>
            </div>
        </div>
    </div>
</nav>