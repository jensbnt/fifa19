@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://futhead.cursecdn.com/static/img/18/players_alt/p50514925.png">
                    </div>
                    <div class="card-body text-center">
                        <h4>Create Player</h4>
                        <p>Here you can create your own players. You can make them one by one, or add a bunch of players
                            using a file.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-primary btn-block" href="{{ route('players.create') }}">Form</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success btn-block" href="{{ route('players.file') }}">File</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://cdn.bleacherreport.net/images/team_logos/328x328/belgium_national_football.png">
                    </div>
                    <div class="card-body text-center">
                        <h4>Create Team</h4>
                        <p>Organize your players into teams! Teams enable you to keep track of games, goals and assists
                            of a group of players.</p>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <a class="btn btn-primary btn-block" href="{{ route('teams.create') }}">Form</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="text-center mt-3">
                        <img style="width: 20%;"
                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSwhmLEZJda6rH-bQSl1FnE_6yTtlZIcydu04SURP2WCMpF6f6">
                    </div>
                    <div class="card-body text-center">
                        <h4>Create Trade</h4>
                        <p>Keep track of your expenses with our <b>NEW</b> trade manager. This section allows you to
                            view your current profits.</p>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <a class="btn btn-primary btn-block" href="{{ route('trades.create') }}">Form</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

