@extends('layout.main')

@section('content')
    <div class="text-center mt-5">
        <div class="row">
            <div class="col-12">
                <h1>Demo application</h1>
                <p>
                    Use navigation at the top.
                </p>
                <p>
                    <a href="{{route('restricted_page_demo')}}">Restricted page demo</a>
                </p>
            </div>
        </div>
    </div>
@endsection
