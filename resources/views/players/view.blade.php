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

                        @if(count($player->teamPlayers) > 0)
                            <hr>

                            <div class="row">
                                <div class="col-md-7"><b>Total games:</b></div>
                                <div class="col-md-4 text-right">{{ isset($player->total_games) ? number_format($player->total_games, 0, ",", ".") : "-" }}</div>
                            </div>

                            <div class="row">
                                <div class="col-md-7"><b>Total goals:</b></div>
                                <div class="col-md-4 text-right">{{ isset($player->total_goals) ? number_format($player->total_goals, 0, ",", ".") : "-" }}</div>
                            </div>

                            <div class="row">
                                <div class="col-md-7"><b>Total assists:</b></div>
                                <div class="col-md-4 text-right">{{ isset($player->total_assists) ? number_format($player->total_assists, 0, ",", ".") : "-" }}</div>
                            </div>

                            <div class="row">
                                <div class="col-md-7"><b>Total contributions:</b></div>
                                <div class="col-md-4 text-right">
                                    <span style="color: {{ $player->total_ctr < 0.5 ? "#ff0000" : ($player->total_ctr < 1 ? "#ffa500" : "#2ca02c") }};">{{ isset($player->total_ctr) ? number_format($player->total_ctr, 3, ",", ".") : "-" }}</span>
                                </div>
                            </div>
                        @endif

                        @if(count($player->trades) > 0)
                            <hr>

                            <div class="row">
                                <div class="col-md-7"><b>Total bought:</b></div>
                                <div class="col-md-4 text-right">
                                    <span style="color: blue;">{{ number_format($player->total_buy, 0, ",", ".") }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7"><b>Total sold:</b></div>
                                <div class="col-md-4 text-right">
                                    <span style="color: dodgerblue;">{{ number_format($player->total_sell, 0, ",", ".") }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7"><b>Total profited:</b></div>
                                <div class="col-md-4 text-right">
                                    <span style="color: {{ $player->total_profit < 0 ? "#ff0000" : "#2ca02c" }};">{{ number_format($player->total_profit, 0, ",", ".") }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($player->teamPlayers as $teamPlayer)
                            <li class="list-group-item"><a
                                        href="{{ route('teams.view', ['id' => $teamPlayer->team->id]) }}">{{ $teamPlayer->team->name }}</a>
                                ♦ {{ $teamPlayer->games == 0 ? number_format(0, 1, ",", ".") : number_format(($teamPlayer->goals + $teamPlayer->assists) / $teamPlayer->games, 1, ",", ".") }}
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
                        <form method="POST" action="{{ route('players.view', ['id' => $player->id]) }}">
                            {{ csrf_field() }}

                            <div class="form-row form-group">
                                <div class="col-md-4">
                                    <input type="number" id="inputBuy" name="buy_price" class="form-control"
                                           placeholder="Buy Price"
                                           value="{{ old('buy_price') != "" ? old('buy_price') : "" }}">
                                </div>

                                <div class="col-md-4">
                                    <input type="number" id="inputSell" name="sell_price" class="form-control"
                                           placeholder="Sell Price"
                                           value="{{ old('sell_price') != "" ? old('sell_price') : ""}}">
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-dark btn-block">Add Trade</button>
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
                    @if ($errors->any())
                        <ul class="list-group list-group-flush">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        @if(count($trades) > 0)
            <div class="row">
                <div class="col-md">
                    <table class="table table-striped table-hover bg-table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 30%">Created</th>
                            <th scope="col" style="width: 30%">Last updated</th>
                            <th class="text-right" scope="col" style="width: 10%">Buy</th>
                            <th class="text-right" scope="col" style="width: 10%">Sell</th>
                            <th class="text-right" scope="col" style="width: 10%">Profit</th>
                            <th class="text-right" scope="col" style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trades as $trade)
                            <tr>
                                <td class="align-middle">{{ $trade->created_at }}</td>
                                <td class="align-middle">{{ $trade->updated_at }}</td>
                                <td class="align-middle text-right">
                                    <span style="color: blue;">{{ number_format($trade->buy_price, 0, ",", ".") }}</span>
                                </td>
                                <td class="align-middle text-right">
                                    <span style="color: dodgerblue;">{{ number_format($trade->sell_price, 0, ",", ".")  }}</span>
                                </td>
                                @if($trade->sell_price != 0)
                                    <td class="align-middle text-right">
                                        <span style="color: {{ $trade->profit < 0 ? "#ff0000" : "#2ca02c" }};">{{ number_format($trade->profit, 0, ",", ".") }}</span>
                                    </td>
                                @else
                                    <td class="align-middle text-right">{{ "-" }}</td>
                                @endif
                                <td class="align-middle text-center">
                                    <a class="btn btn-primary btn-block"
                                       href="{{ route('trades.edit', ['id' => $trade->id]) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
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