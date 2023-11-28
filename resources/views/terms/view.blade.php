@extends('layout.main')

@section('content')
    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                {!! $terms['content'] !!}
            </div>
        </div>
    </div>
@endsection
