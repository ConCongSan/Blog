<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Blog</title>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#">Home</a>
            </div>
            <div class="col-4 text-center">
                <input class="form-control" type="text" name="" placeholder="Search">
            </div>
        </div>
        <form action="{{ route('search') }}" method="get">
            <div class="col-4 d-flex justify-content-end align-items-center">
                <!-- <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a> -->
                <select class="form-control form-control-sm" name="tag_id">
                    @foreach($tag as $listtag)
                        <option value="{{ $listtag->id }}">{{ $listtag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Tìm</button>
        </form>
    </header>
    <div class="row mb-2">
        <div class="col-md-6">
            @foreach($post as $listpost)
                <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">{{$listpost->username}}</strong>
                        <h3 class="mb-0">{{$listpost->title}}</h3>
                        <div class="mb-1 text-muted">{{$listpost->created_at}}</div>
                        <p class="card-text mb-auto">{{$listpost->content}}</p>
                        <a href="{{ route('detail',['id'=>$listpost->id])}}" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img src="anh/{{ $listpost->image }}" width="200" height="250">
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="carousel_btn-container">
        {{$post->links('vendor\pagination\bootstrap-4')}}

    </div>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

</html>