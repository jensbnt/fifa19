@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row text-center align-items-center">
            <div class="col-md-2 mb-3">
                <img src="{{ URL::to('images/fifa19.jpg') }}" class="card-img-top">
            </div>
            <div class="col-md-8 mb-3">
                <h1 class="display-4">Welcome</h1>
                <p class="lead">Personal FIFA 19 manager</p>
            </div>
            <div class="col-md-2 mb-3">
                <img src="https://s3.amazonaws.com/freebiesupply/large/2x/playstation-logo-png-transparent.png"
                     class="card-img-top">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><h1>Recent Updates</h1></li>
                    <li class="list-group-item"><b>v1.0</b> - Players & teams</li>
                    <li class="list-group-item"><b>v0.*</b> - Alpha stage</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><h1>Last updated players</h1></li>
                    @foreach($players as $player)
                        <li class="list-group-item">
                            {{ $player->name }} ♦ {{ $player->teamname }} ♦ {{ $player->goals }} goals
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

