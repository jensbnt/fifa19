@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md text-center">
                <div class="text-center mt-3 mb-3">
                    <img style="width: 30%;"
                         src="https://thinkspace.com/wp-content/uploads/2014/01/404.png">
                </div>

                <h1 class="display-4">Sorry, this page doesn't exist!</h1>
                <p class="lead">{{ isset($error) ? $error : "Something went wrong" }}</p>
                <p>Well it seems like this page has autism, but maybe you wanted to visit <a
                            href="{{ route('home.index') }}">home</a>, <a
                            href="{{ route('players.index') }}">players</a> or <a href="{{ route('teams.index') }}">teams</a>.
                </p>
            </div>
        </div>
    </div>
@endsection

