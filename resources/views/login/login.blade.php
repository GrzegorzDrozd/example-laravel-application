@extends('layout.main')

@section('content')
    <div class="text-center mt-3">
        <div class="row">
            <div class="col-3 offset-3">
                <form method="post" action="{{route('login')}}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @error('email')
                        <strong class="alert-warning">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                        @error('password')
                        <strong class="alert-warning">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a class="btn btn-secondary" href="{{route('register')}}">Register</a>
                    <a href="{{route('password.request')}}" class="btn btn-secondary">Forgot my password</a>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>
            </div>
        </div>
    </div>

@endsection
