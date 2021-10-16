<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="position-relative">
        <ul class="list-medium-category d-flex justify-content-center">
            @foreach($mediums as $medium)
            <a class="link-medium-category" href="#">
            <li class="medium-category" 
                style="background:linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,.6)), 
                url({{asset('/images/'. $medium->image)}});">
                <span class="text-photo text-photo-medium">{{$medium->name}}</span>
                <span class="text-photo text-photo-sum">154.000 items</span>
            </li>
            </a>
            @endforeach
            
        </ul>
    </div>
</div>