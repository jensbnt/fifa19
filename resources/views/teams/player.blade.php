@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3">
                    <div class="card-header text-center text-muted">
                        Edit teamplayer
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"><b>Player</b></div>
                            <div class="col-md-9"><a
                                        href="{{ route('players.view', ['id' => $teamplayer->player->id]) }}">{{ $teamplayer->player->name }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Rating</b></div>
                            <div class="col-md-9">{{ $teamplayer->player->rating }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Position</b></div>
                            <div class="col-md-9">{{ $teamplayer->player->position }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Type</b></div>
                            <div class="col-md-9">{{ $teamplayer->player->cardtype }}</div>
                        </div>
                        <hr>
                        <form method="POST" action="{{ route('teams.player', ['id' => $teamplayer->id]) }}">
                        {{ csrf_field() }}

                        <!-- GAMES -->
                            <div class="form-row form-group">
                                <label for="inputGames" class="col-md-3 col-form-label">Games</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputGames" name="games" class="form-control"
                                           placeholder="Games"
                                           value="{{ old('games') != "" ? old('games') : $teamplayer->games }}">
                                </div>
                            </div>

                            <!-- GOALS -->
                            <div class="form-row form-group">
                                <label for="inputGoals" class="col-md-3 col-form-label">Goals</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputGoals" name="goals" class="form-control"
                                           placeholder="Goals"
                                           value="{{ old('goals') != "" ? old('goals') : $teamplayer->goals }}">
                                </div>
                            </div>

                            <!-- ASSISTS -->
                            <div class="form-row form-group">
                                <label for="inputAssists" class="col-md-3 col-form-label">Assists</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputAssists" name="assists" class="form-control"
                                           placeholder="Assists"
                                           value="{{ old('assists') != "" ? old('assists') : $teamplayer->assists }}">
                                </div>
                            </div>

                            <!-- BUTTONS -->
                            <div class="form-row form-group">
                                <div class="col-md-4 offset-md-3">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Save
                                    </button>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <a href="{{ route('teams.view', ['id' => $teamplayer->team->id]) }}"
                                       class="btn btn-danger btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="col-md-6 offset-md-3 mb-3">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection