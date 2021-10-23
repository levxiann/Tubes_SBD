<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
	<title>{{$articles->title}}</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" >
  <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"  rel="stylesheet" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href={{asset('css/article.css')}} rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
        data-mdb-target="#navbarToggleExternalContent2" aria-controls="navbarToggleExternalContent2"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>
      <a class="nav-link" style="margin-right: auto;" href="https://artsandculture.google.com/"><h5><b>Google</b> Arts & Culture</h5></a>
      </a>
    </div>
  </nav>

<div class="background" id="title" style="background-image: url({{asset('/images/articles/'. $articles->image)}});">
  <div id="text">
    <p><span style="font-size: 40px">{{$articles->title}}</span></p>
    <hr><p><span style="font-size: 20px">Oleh {{$articles->credit}}</span></p>
  </div>
</div>
<div class="background" id="content">
  <a>{{$articles->content}}</a>
</div>
<div class="footer">
  <hr>
  <p><span style="font-size: 30px">Kredit: Cerita</span></p>
  <p><span style="font-size: 15px">Text: {{$articles->writer}}</span></p>
</div>


<!-- Javascript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.jss"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(window).scroll(function(){
        if($(this).scrollTop() < $("#title").height()){
          $(".navbar").removeClass("bg-light");
        } else{
          $(".navbar").addClass("bg-light");
        }
      });
    });
  </script>
</body>
</html>