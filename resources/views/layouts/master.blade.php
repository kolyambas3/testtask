<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Admin Panel</title>
</head>
<body>
<div class="container">
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="{{route('post.index')}}">Posts</a>
            </div>
            @if( auth()->check() )
                @can('manage', auth()->user())
                    <a href="{{route('register')}}" class="btn btn-warning">Create user</a>
                @endcan
                <li class="nav-item">
                    <a class="btn btn-danger" href="{{route('logout')}}">Log Out</a>
                </li>
            @else
                <a href="{{route('register')}}" class="btn btn-danger">register</a>
                <a href="{{route('login')}}" class="btn btn-success">login</a>
            @endif
        </div>
    </div>
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
