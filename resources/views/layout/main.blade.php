<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Simple demo app for user registration" />
    <meta name="author" content="Grzegorz Drozd" />
    <title>User registration demo app</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Simple user registration demo app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a></li>
                @auth
                <li class="nav-item"><a class="nav-link" href="{{route('logoff')}}">Logoff {{Auth::user()->name}}</a></li>
                @endauth
                @guest
                <li class="nav-item"><a class="nav-link" href="{{route('login_form')}}">Login</a></li>
                @endguest
                <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page content-->
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif
    @yield('content')
</div>
<!-- Core theme JS-->
<script src="/js/scripts.js"></script>
</body>
</html>
