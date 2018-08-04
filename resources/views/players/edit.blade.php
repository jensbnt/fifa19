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
                        {{ $player->name }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('players.edit', ['id' => $player->id]) }}">
                        {{ csrf_field() }}

                        <!-- NAME -->
                            <div class="form-row form-group">
                                <label for="inputName" class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputName" name="name" class="form-control"
                                           placeholder="Name"
                                           value="{{ old('name') != "" ? old('name') : $player->name }}">
                                </div>
                            </div>

                            <!-- RATING -->
                            <div class="form-row form-group">
                                <label for="inputRating" class="col-md-3 col-form-label">Rating</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputRating" name="rating" class="form-control"
                                           placeholder="Rating"
                                           value="{{ old('rating') != "" ? old('rating') : $player->rating }}">
                                </div>
                            </div>

                            <!-- POSITION -->
                            <div class="form-row form-group">
                                <label for="inputPosition" class="col-md-3 col-form-label">Position</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputPosition" name="position" class="form-control"
                                           placeholder="Position"
                                           value="{{ old('position') != "" ? old('position') : $player->position }}">
                                </div>
                            </div>

                            <!-- CARDTYPE -->
                            <div class="form-row form-group">
                                <label for="inputCardtype" class="col-md-3 col-form-label">Type</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputCardtype" name="cardtype" class="form-control"
                                           placeholder="Type"
                                           value="{{ old('cardtype') != "" ? old('cardtype') : $player->cardtype }}">
                                </div>
                            </div>

                            <hr>

                            <!-- PLAYER IMAGE LINK -->
                            <div class="form-row form-group">
                                <label for="inputPlayerImage" class="col-md-3 col-form-label">Player Image</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputPlayerImage" name="playerImage" class="form-control"
                                           placeholder="Player Image"
                                           value="{{ old('playerImage') != "" ? old('playerImage') : $player->player_img_link }}">
                                </div>
                            </div>

                            <!-- NATION IMAGE LINK -->
                            <div class="form-row form-group">
                                <label for="inputNationImage" class="col-md-3 col-form-label">Nation Image</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputNationImage" name="nationImage" class="form-control"
                                           placeholder="Nation Image"
                                           value="{{ old('nationImage') != "" ? old('nationImage') : $player->nation_img_link }}">
                                </div>
                            </div>

                            <!-- CLUB IMAGE LINK -->
                            <div class="form-row form-group">
                                <label for="inputClubImage" class="col-md-3 col-form-label">Club Image</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputClubImage" name="clubImage" class="form-control"
                                           placeholder="Club Image"
                                           value="{{ old('clubImage') != "" ? old('clubImage') : $player->club_img_link }}">
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
                                    <a href="{{ route('players.view', ['id' => $player->id]) }}"
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