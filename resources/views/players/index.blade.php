@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <form class="form-horizontal" method="GET" action="{{ route('players.index') }}">
            {{ csrf_field() }}

            <div class="form-row form-group">
                <div class="col-md-10 input-group">
                    <input type="text" id="inputName" name="name" class="form-control" placeholder="Name"
                           value="{{ isset($_GET['name']) ? $_GET['name'] : "" }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark btn-block">Sort</button>
                </div>
            </div>
            <div class="form-row form-group">
                <div class="col-md-2">
                    <select id="inputPosition" name="position" class="form-control">
                        <option value="" disabled selected hidden>Position</option>
                        <option value=""></option>
                        @foreach($positions as $position)
                            <option value="{{ $position->position }}" {{ isset($_GET['position']) && $_GET['position'] == $position->position ? "selected" : "" }}>{{ $position->position }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="inputCardtype" name="cardtype" class="form-control">
                        <option value="" disabled selected hidden>Type</option>
                        <option value=""></option>
                        @foreach($cardtypes as $cardtype)
                            <option value="{{ $cardtype->cardtype }}" {{ isset($_GET['cardtype']) && $_GET['cardtype'] == $cardtype->cardtype ? "selected" : "" }}>{{ $cardtype->cardtype }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" id="inputMinRating" name="minRating" class="form-control"
                           placeholder="Min. rating" min="1" max="99"
                           value="{{ isset($_GET['minRating']) ? $_GET['minRating'] : "" }}">
                </div>
                <div class="col-md-2">
                    <input type="number" id="inputMaxRating" name="maxRating" class="form-control"
                           placeholder="Max. rating" min="1" max="99"
                           value="{{ isset($_GET['maxRating']) ? $_GET['maxRating'] : "" }}">
                </div>
                <label for="inputSort" class="col-md-2 col-form-label text-center"><b>Order by:</b></label>
                <div class="col-md-2">
                    <select id="inputSort" name="sort" class="form-control">
                        <option value="r" {{ isset($_GET['sort']) && $_GET['sort'] == "r" ? "selected" : "" }}>Rating
                        </option>
                        <option value="n" {{ isset($_GET['sort']) && $_GET['sort'] == "n" ? "selected" : "" }}>Name
                        </option>
                        <option value="p" {{ isset($_GET['sort']) && $_GET['sort'] == "p" ? "selected" : "" }}>
                            Position
                        </option>
                        <option value="t" {{ isset($_GET['sort']) && $_GET['sort'] == "t" ? "selected" : "" }}>Type
                        </option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <caption>Players ♦ {{ $players->total() }} results</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col" style="width: 5%"></th>
                        <th scope="col" style="width: 5%"></th>
                        <th scope="col" style="width: 5%"></th>
                        <th scope="col" style="width: 45%">Name</th>
                        <th scope="col" style="width: 10%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 15%">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($players); $i++)
                        <tr>
                            <th class="align-middle"
                                scope="row">{{ ($players->currentPage() - 1) * $players->perPage()  + $i + 1 }}</th>
                            <td class="align-middle">
                                @if(count($players[$i]->teamPlayers) != 0)
                                    <span class="badge badge-warning">Team</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <img style="width: 30px;" src="{{ $players[$i]->nation_img_link }}">
                            </td>
                            <td class="align-middle">
                                <img style="width: 30px;" src="{{ $players[$i]->club_img_link }}">
                            </td>
                            <td class="align-middle"><a
                                        href="{{ route('players.view', ['id' => $players[$i]->id]) }}">{{ $players[$i]->name }}</a>
                            </td>
                            <td class="align-middle">{{ $players[$i]->rating }}</td>
                            <td class="align-middle">{{ $players[$i]->position }}</td>
                            <td class="align-middle">{{ $players[$i]->cardtype }}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                {{ $players->links() }}
            </div>
        </div>
    </div>
@endsection

