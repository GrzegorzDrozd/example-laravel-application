@extends('layout.main')


@section('content')
    <div class="text-center mt-3">
        <div class="row">
            <div class="col-3 offset-3">
                <form method="post" action="{{route('create_user')}}" autocomplete="off">
                    <div class="mb-3">
                        <label for="id_username" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" id="id_username" value="{{ old('username') }}" autocomplete="new-password">
                        @error('username')
                        <strong class="alert-warning">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="id_email" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="id_email" aria-describedby="emailHelp"  value="{{ old('email') }}" autocomplete="new-password">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @error('email')
                        <strong class="alert-warning">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="id_password"  autocomplete="new-password">
                        @error('password')
                        <strong class="alert-warning">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="id_password_confirmation" class="form-label">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="id_password_confirmation"  autocomplete="new-password">
                        @error('password_confirmation')
                        <strong class="alert-warning">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input name="terms_acceptance" type="checkbox" class="form-check-input" id="id_terms_acceptance" value="true" />
                        <label class="form-check-label" for="id_terms_acceptance">Accept terms and conditions</label>
                        <br />
                        <a href="{{route('view_terms_and_conditions')}}" target="_blank">view terms and conditions</a>
                        @error('terms_acceptance')
                        <br />
                        <strong class="alert-warning">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create account</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="terms" value="{{$terms}}" />
                </form>
            </div>
        </div>
    </div>
@endsection
