@extends('layout.main')


@section('content')
    <div class="text-center mt-3">
        <div class="row">
            <div class="col-3 offset-3">
                <form method="post" action="{{route('password.update')}}" autocomplete="off">
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
                    <button type="submit" class="btn btn-primary">Set new password</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="token" value="{{ $token }}" />
                    <input type="hidden" name="email" value="{{ $email }}" />

                </form>
            </div>
        </div>
    </div>
@endsection
