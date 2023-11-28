@extends('layout.main')

@section('content')
    <div class="mt-3">
        <div class="row">
            <div class="col-3 offset-3">
                <p>To access some pages your account needs to be activated.</p>
                <p>Click on a link in activation email or use button below to re-send that email.</p>

                <form method="post" action="{{route('verification.notice.send')}}">
                    <input type="submit" value="Re-send activation email" class="btn btn-primary" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>
            </div>
        </div>
    </div>

@endsection
