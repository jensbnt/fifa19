@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row text-center align-items-center">
            <div class="col-md-2 mb-3">
                <img src="https://lh3.googleusercontent.com/0OkazSaeKunzFw09BhD2zdEdOeavQcT9ejfkq1jl9fgTeuIjL6OMGnQvq-rrhxtpsCM=s180-rw"
                     class="card-img-top">
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
            <div class="col-md">
                <form method="GET" action="{{ route('home.index') }}">
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-flex mb-3">
                        <button name="sort" value="m"
                                class="btn {{ !isset($_GET['sort']) || $_GET['sort'] == "m" ? "btn-dark" : "btn-secondary" }}">
                            Games
                        </button>
                        <button name="sort" value="g"
                                class="btn {{ isset($_GET['sort']) && $_GET['sort'] == "g" ? "btn-dark" : "btn-secondary" }}">
                            Goals
                        </button>
                        <button name="sort" value="a"
                                class="btn {{ isset($_GET['sort']) && $_GET['sort'] == "a" ? "btn-dark" : "btn-secondary" }}">
                            Assists
                        </button>
                        <button name="sort" value="c"
                                class="btn {{ isset($_GET['sort']) && $_GET['sort'] == "c" ? "btn-dark" : "btn-secondary" }}">
                            Contributions
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
                                <span style="color: {{ $players[$i]->ctr < 0.5 ? "#ff0000" : ($players[$i]->ctr < 1 ? "#ffa500" : "#2ca02c") }};">{{ isset($players[$i]->ctr) ? number_format($players[$i]->ctr, 3, ",", ".") : "-" }}</span>
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

