@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3">
                    <div class="card-header text-center text-muted">
                        Create trade
                    </div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://i0.wp.com/www.gokartscentralcoast.com/wp-content/uploads/2016/03/whoops.png">
                    </div>
                    <div class="card-body text-center">
                        Currently there is no form dedicated to create a new trade. To add trades, simply head over
                        to the <a href="{{ route('players.index') }}">players</a> page and find the player you want to
                        trade. You can then click on the player to add a new trade.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection