@extends('terms.view')

@section('content')
    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                <h1>You need to accept new terms and conditions to continue using this website.</h1>
            </div>
        </div>
    </div>
    @parent

    <div class="mt-3">
        <div class="row">
            <div class="col-3 offset-3">
                <form method="post" action="{{route('accept_terms_and_conditions')}}">
                    <input type="submit" value="Accept" class="btn btn-primary" />
                    <input type="hidden" name="id" value="{{$terms['id']}}" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>
            </div>
        </div>
    </div>

@endsection
