@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row text-center align-items-center">
            <div class="col-md-2 mb-3">
                <img src="https://lh3.googleusercontent.com/0OkazSaeKunzFw09BhD2zdEdOeavQcT9ejfkq1jl9fgTeuIjL6OMGnQvq-rrhxtpsCM=s180-rw" class="card-img-top">
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
                    <li class="list-group-item"><b>v2.0</b> - Website redesign, ready for FIFA 19</li>
                    <li class="list-group-item"><b>v1.16</b> - Nation & Club database</li>
                    <li class="list-group-item"><b>v1.15</b> - Stats</li>
                    <li class="list-group-item"><b>v1.14</b> - Advanced sort</li>
                    <li class="list-group-item"><b>v1.13</b> - Team formations + pictures</li>
                    <li class="list-group-item"><b>v1.12</b> - Backups</li>
                    <li class="list-group-item"><b>v1.11</b> - Add players with .csv</li>
                    <li class="list-group-item"><b>v1.10</b> - Edit players</li>
                    <li class="list-group-item"><b>v1.9</b> - Add game option</li>
                    <li class="list-group-item"><b>v1.8</b> - Added top players</li>
                    <li class="list-group-item"><b>v1.7</b> - Added player sorting on team page</li>
                    <li class="list-group-item"><b>v1.6</b> - Added player graphics (picture, club and nation)</li>
                    <li class="list-group-item"><b>v1.5</b> - Global player stats</li>
                    <li class="list-group-item"><b>v1.4</b> - Edit player's games, goals and assists</li>
                    <li class="list-group-item"><b>v1.3</b> - Add custom players</li>
                    <li class="list-group-item"><b>v1.2</b> - Add a team description and edit teams</li>
                    <li class="list-group-item"><b>v1.1</b> - User logins</li>
                    <li class="list-group-item"><b>v1.0</b> - Players & teams</li>
                    <li class="list-group-item"><b>v0.*</b> - Alpha stage</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><h1>Last updated players</h1></li>
                    @foreach($players as $player)
                        <li class="list-group-item">
                            {{ $player->name }} ♦ {{ $player->teamname }} ♦ {{ number_format($player->goals, 0, ",", ".") }} goals
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

