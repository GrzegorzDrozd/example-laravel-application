@extends('layout.main')

@section('content')
    <div class="text-center mt-3">
        <div class="row">
            <div class="col-3 offset-3">
                <form method="post" action="{{route('password.email')}}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Recover password</button>
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                </form>
            </div>
        </div>
    </div>
@endsection
