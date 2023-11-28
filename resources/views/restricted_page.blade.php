@extends('layout.main')


@section('content')
    <div class="text-center mt-3">
        <div class="row">
            <div class="col-3 offset-3">
                <h1>Restricted page</h1>
                <p>
                    This page requires user to be logged in and user email to be verified.
                </p>
            </div>
        </div>
    </div>
@endsection
