<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlogSite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body>

<?php
$title = '1,300,000+ Best Free Nature Pictures & Images [HD] - Pixabay, Nature Pictures & Images'; 
$title1 = 'The browser chooses the most adequate image to display at a given point of time'; 


$blogText = 'What platform comes to mind first? Certainly—WordPress. This open-source site creation tool is a perfect choice, not only for websites but also for any blog.';
$blogText1 = "Each string in the list must have at least a width descriptor or a pixel density descriptor to be valid. The two types of descriptors should not be mixed together and only one should be used consistently throughout the list. Among the list, the value of each descriptor must be unique. The browser chooses the most adequate image to display at a given point of time. I";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">BlogSite</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Latest Blog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Finance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Sports</a>
        </li>
        @if (auth()->guard('author')->user())
            <li class="nav-item">
                <a class="nav-link text-primary" href="{{ route('dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout')}}">Logout</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-primary" href="{{ route('author.login')}}">Author Login</a>
            </li>
        @endif
        
        
        </ul>
    </div>
  </div>
</nav>

<div class="main-section">
<div class="container">
    <div class="row">
        @if (empty($articles)) 
          <p style="text-align: center;margin-top: 19px;">Articles is empty. please <a href="{{ route('author.login')}}">login</a> and create one.</p>
        @else
            @foreach ($articles as $article)
                <div class="col-md-4">
                    <div class="blog">
                        <div class="category">{{$article->category->name}}</div>
                        <div class="imgBg" style="background-image: url('{{ asset('storage/BlogImages/' . $article->image); }}');">
                            <div class="overlay">
                                <h3><?= substr($article->title,0,75)."..."; ?></h3>
                            </div>
                        </div>
                        <div class="other">
                            <i class="fa fa-tag"></i>
                            @foreach ($article->AllTags as $item)
                                {{$item}} ,
                            @endforeach
                        </div>
                        <div class="content">
                            <p><?= substr($article->description,0,135).".. "; ?><a href="#">Read more..</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        

        

        
        
    </div>
</div>
</div>


<style>
.blog {
    margin-top: 20px;
    margin-bottom: 20px;
    box-shadow: 4px 6px 10px #88888852;
    border-radius: 17px;
} 
.blog .imgBg {
    height: 300px;
    background-size: cover;
    background-position: center;
    position: relative;
}
h3 {
    color: white;
    margin: 0;
    font-size: 20px;
    position: absolute;
    bottom: 16px;
    padding: 0px 10px;
}
.overlay {
    background: rgba(0,0,0,0.2);
    height: 300px;
}
.category {
	background: #0087ff;
	padding: 3px 17px;
	width: max-content;
	color: white;
	border-radius: 23px;
	font-size: 15px;
	position: absolute;
	z-index: 1;
	margin-top: 12px;
	margin-left: 12px;
}
.other {
    padding: 9px;
    color: #00000096;
}
.content p {
    margin: 0;
    padding: 14px;
    padding-top: 0;
    padding-bottom: 20px;
}
.read {
    margin: 0 auto;
    text-align: center;
    padding-bottom: 16px;
    padding-top: 0;
}
.content {
	height: 110px;
}

</style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>




    
  </body>
</html>