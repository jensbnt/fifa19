@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <form class="form-horizontal" method="GET" action="{{ route('stats.index') }}">
            {{ csrf_field() }}

            <div class="form-row form-group">
                <div class="col-md-10">
                    <select id="inputSort" name="sort" class="form-control">
                        <option value="m" {{ isset($_GET['sort']) && $_GET['sort'] == "m" ? "selected" : "" }}>Games
                        </option>
                        <option value="g" {{ isset($_GET['sort']) && $_GET['sort'] == "g" ? "selected" : "" }}>Goals
                        </option>
                        <option value="a" {{ isset($_GET['sort']) && $_GET['sort'] == "a" ? "selected" : "" }}>Assists
                        </option>
                        <option value="c" {{ isset($_GET['sort']) && $_GET['sort'] == "c" ? "selected" : "" }}>
                            Contributions
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark btn-block">Sort</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%">#</th>
                        <th scope="col" style="width: 35%">Name</th>
                        <th scope="col" style="width: 5%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 15%">Type</th>
                        <th scope="col" style="width: 5%">Games</th>
                        <th scope="col" style="width: 5%">Goals</th>
                        <th scope="col" style="width: 5%">Assists</th>
                        <th scope="col" style="width: 10%">Contributions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($players); $i++)
                        <tr>
                            <th class="align-middle" scope="row">
                                {{ number_format(($players->currentPage() - 1) * $players->perPage()  + $i + 1, 0, ",", ".") }}
                            </th>
                            <td class="align-middle"><a
                                        href="{{ route('players.view', ['id' => $players[$i]->id]) }}">{{ $players[$i]->name }}</a>
                            </td>
                            <td class="align-middle">{{ $players[$i]->rating }}</td>
                            <td class="align-middle">{{ $players[$i]->position }}</td>
                            <td class="align-middle">{{ $players[$i]->cardtype }}</td>
                            <td class="align-middle">{{ number_format($players[$i]->games, 0, ",", ".") }}</td>
                            <td class="align-middle">{{ number_format($players[$i]->goals, 0, ",", ".") }}</td>
                            <td class="align-middle">{{ number_format($players[$i]->assists, 0, ",", ".") }}</td>
                            <td class="align-middle">
                                <span style="color: {{ $players[$i]->ctr < 0.5 ? "#ff0000" : $players[$i]->ctr < 1 ? "#ffa500" : "#2ca02c" }};">{{ isset($players[$i]->ctr) ? number_format($players[$i]->ctr, 3, ",", ".") : "-" }}</span>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                {{ $players->links() }}
            </div>
        </div>
    </div>
@endsection

