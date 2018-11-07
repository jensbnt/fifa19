@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-3">
                    <div class="card-header text-center text-muted">
                        Create game
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.game', ['id' => $team->id]) }}">
                        {{ csrf_field() }}

                        @foreach($team->teamPlayers as $teamPlayer)
                            <!-- Player -->
                                <div class="form-row form-group">
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="teamplayer{{$teamPlayer->id}}" name="checked[]"
                                                   value="{{ $teamPlayer->id }}" checked>
                                            <label class="custom-control-label"
                                                   for="teamplayer{{$teamPlayer->id}}">{{ $teamPlayer->player->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="goals{{ $teamPlayer->id }}" class="form-control"
                                               placeholder="Goals"
                                               value="0">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="assists{{ $teamPlayer->id }}" class="form-control"
                                               placeholder="Assists"
                                               value="0">
                                    </div>
                                </div>
                        @endforeach

                        <!-- BUTTONS -->
                            <div class="form-row form-group">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Save
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('teams.view', ['id' => $team->id]) }}"
                                       class="btn btn-danger btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="col-md-8 offset-md-2 mb-3">
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