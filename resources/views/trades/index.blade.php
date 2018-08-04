@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md text-center">
                <h1 class="display-1">Comming soon ...</h1>
                <p class="lead">Trades</p>

                <br>

                <div class="row">
                    <div class="col-md-3 offset-md-3">
                        <a href="{{ route('players.index') }}" class="btn btn-primary btn-block">Players</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('teams.index') }}" class="btn btn-primary btn-block">Teams</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

