@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>{{ $player->name }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7"><b>Rating:</b></div>
                            <div class="col-md-4 text-right">{{ $player->rating }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-7"><b>Position:</b></div>
                            <div class="col-md-4 text-right">{{ $player->position }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-7"><b>Type:</b></div>
                            <div class="col-md-4 text-right">{{ $player->cardtype }}</div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-7"><b>Total games:</b></div>
                            <div class="col-md-4 text-right">{{ isset($player->games) ? $player->games : "-" }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-7"><b>Total goals:</b></div>
                            <div class="col-md-4 text-right">{{ isset($player->goals) ? $player->goals : "-" }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-7"><b>Total assists:</b></div>
                            <div class="col-md-4 text-right">{{ isset($player->assists) ? $player->assists : "-" }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-7"><b>Total contributions:</b></div>
                            <div class="col-md-4 text-right">
                                <span style="color: {{ $player->ctr < 0.5 ? "#ff0000" : $player->ctr < 1 ? "#ffa500" : "#2ca02c" }};">{{ isset($player->ctr) ? $player->ctr : "-" }}</span>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($player->teamPlayers as $teamPlayer)
                            <li class="list-group-item"><a
                                        href="{{ route('teams.view', ['id' => $teamPlayer->team->id]) }}">{{ $teamPlayer->team->name }}</a>
                                ♦ {{ $teamPlayer->games == 0 ? "0.0" : number_format(($teamPlayer->goals + $teamPlayer->assists) / $teamPlayer->games, 1) }}
                                contributions
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md mb-3">
                        <img class="card-img-top" src="{{ $player->player_img_link }}">
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top" src="{{ $player->nation_img_link }}">
                    </div>
                    <div class="col-md-6">
                        <img class="card-img-top" src="{{ $player->club_img_link }}">
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>Options</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('players.view', ['id' => $player->id]) }}">
                            {{ csrf_field() }}

                            <div class="form-row form-group">
                                <div class="col-md-8">
                                    <select id="teamid" class="form-control" name="teamid">
                                        <option value="" disabled selected hidden>Select team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-dark btn-block">Add to team</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6">
                                <a href="{{ route('players.edit', ['id' => $player->id]) }}"
                                   class="btn btn-primary btn-block">Edit</a>
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
                    Do you really want to delete {{ $player->name }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('players.view', ['id' => $player->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="delete">
                        <button class="btn btn-danger btn-ok">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection