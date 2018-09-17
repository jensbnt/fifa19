@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 text-center">
                <div class="text-center mt-3 mb-3">
                    <img style="width: 70%;"
                         src="https://i0.wp.com/www.gokartscentralcoast.com/wp-content/uploads/2016/03/whoops.png">
                </div>
                <p class="lead">{{ $error }}</p>

                <br>

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('home.index') }}" class="btn btn-primary btn-block">Home</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ URL::previous() }}" class="btn btn-success btn-block">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

