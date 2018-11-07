@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row text-center align-items-center mb-3">
            <div class="col-md-2 mb-3">
                <img src="{{ $team->club_img_link }}" class="card-img-top">
            </div>
            <div class="col-md-8 mb-3">
                <h1 class="display-4">{{ $team->name }}</h1>
                <p class="lead">{{ $team->description }}</p>
            </div>
            <div class="col-md-2 mb-3">
                <img src="{{ $team->club_img_link }}" class="card-img-top">
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <form action="{{ route('teams.view', ['id' => $team->id]) }}" method="get">
                    {{ csrf_field() }}

                    <div class="form-row form-group">
                        <div class="col-md-10">
                            <select id="sort" class="form-control" name="sort">
                                <option value="m" {{ (isset($_GET['sort']) && $_GET['sort'] == "m" ? "selected" : "") }}>
                                    Games
                                </option>
                                <option value="g" {{ (isset($_GET['sort']) && $_GET['sort'] == "g" ? "selected" : "") }}>
                                    Goals
                                </option>
                                <option value="a" {{ (isset($_GET['sort']) && $_GET['sort'] == "a" ? "selected" : "") }}>
                                    Assists
                                </option>
                                <option value="c" {{ (isset($_GET['sort']) && $_GET['sort'] == "c" ? "selected" : "") }}>
                                    Contributions
                                </option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block">
                                Sort
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 25%">Name</th>
                        <th scope="col" style="width: 10%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 15%">Type</th>
                        <th scope="col" style="width: 10%">Games</th>
                        <th scope="col" style="width: 10%">Goals</th>
                        <th scope="col" style="width: 10%">Assists</th>
                        <th scope="col" style="width: 10%">Contributions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td>
                                <a href="{{ route('teams.player', ['id' => $player->team_player_id]) }}">{{ $player->name }}</a>
                            </td>
                            <td>{{ $player->rating }}</td>
                            <td>{{ $player->position }}</td>
                            <td>{{ $player->cardtype }}</td>
                            <td>{{ number_format($player->games, 0, ",", ".") }}</td>
                            <td>{{ number_format($player->goals, 0, ",", ".") }}</td>
                            <td>{{ number_format($player->assists, 0, ",", ".") }}</td>
                            <td>
                                <span style="color: {{ $player->ctr < 0.5 ? "#ff0000" : ($player->ctr < 1 ? "#ffa500" : "#2ca02c") }};">{{ isset($player->ctr) ? number_format($player->ctr, 3, ",", ".") : "-" }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $players->links() }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>Game options</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <label class="form-control" for="">Add new game</label>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('teams.game', ['id' => $team->id]) }}" class="btn btn-primary btn-block">Start</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>Team options</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.view', ['id' => $team->id]) }}">
                            {{ csrf_field() }}

                            <div class="form-row form-group">
                                <div class="col-md-8">
                                    <select id="teamplayerid" class="form-control" name="teamplayerid">
                                        <option value="" disabled selected hidden>Select player</option>
                                        @foreach($players as $player)
                                            <option value="{{ $player->team_player_id }}">{{ $player->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">Delete player</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6">
                                <a href="{{ route('teams.edit', ['id' => $team->id]) }}"
                                   class="btn btn-info btn-block">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <a href="" class="btn btn-danger btn-block" data-toggle="modal"
                                   data-target="#confirm-delete">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONFIRMATION DIALOG -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Warning!</h2>
                </div>
                <div class="modal-body">
                    Do you really want to delete {{ $team->name }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('teams.view', ['id' => $team->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="delete">
                        <button class="btn btn-danger btn-ok">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection