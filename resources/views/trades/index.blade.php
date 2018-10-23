@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h2 class="display-4">Trades</h2>
                        <br>
                        <p><b>Total bought:</b> <span
                                    style="color: blue;">{{ number_format($total_buy, 0, ',', '.') }}</span></p>
                        <p><b>Total sold:</b> <span
                                    style="color: dodgerblue;">{{ number_format($total_sell, 0, ',', '.') }}</span></p>
                        <p><b>Total profited:</b> <span
                                    style="color: {{ $total_profit < 0 ? "#ff0000" : "#2ca02c" }};">{{ number_format($total_profit, 0, ',', '.') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form class="form-horizontal" method="GET" action="{{ route('trades.index') }}">
            {{ csrf_field() }}

            <div class="form-row form-group">
                <div class="col-md-10">
                    <select id="inputDisplay" name="display" class="form-control">
                        <option value="w" {{ isset($_GET['display']) && $_GET['display'] == "w" ? "selected" : "" }}>
                            Last week
                        </option>
                        <option value="m" {{ isset($_GET['display']) && $_GET['display'] == "m" ? "selected" : "" }}>
                            Last month
                        </option>
                        <option value="a" {{ isset($_GET['display']) && $_GET['display'] == "a" ? "selected" : "" }}>All
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark btn-block">Display</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover bg-table">
                    <caption>Trades ♦ {{ number_format($players->total(), 0, ",", ".") }} results</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 5%"></th>
                        <th scope="col" style="width: 5%"></th>
                        <th scope="col" style="width: 25%">Name</th>
                        <th scope="col" style="width: 10%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 15%">Type</th>
                        <th class="text-right" scope="col" style="width: 10%">Buy</th>
                        <th class="text-right" scope="col" style="width: 10%">Sell</th>
                        <th class="text-right" scope="col" style="width: 10%">Profit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($players); $i++)
                        <tr>
                            <td class="align-middle">
                                <img style="width: 30px;" src="{{ $players[$i]->nation_img_link }}">
                            </td>
                            <td class="align-middle">
                                <img style="width: 30px;" src="{{ $players[$i]->club_img_link }}">
                            </td>
                            <td class="align-middle"><a
                                        href="{{ route('trades.edit', ['id' => $players[$i]->trade_id]) }}">{{ $players[$i]->name }}</a>
                            </td>
                            <td class="align-middle">{{ $players[$i]->rating }}</td>
                            <td class="align-middle">{{ $players[$i]->position }}</td>
                            <td class="align-middle">{{ $players[$i]->cardtype }}</td>
                            <td class="align-middle text-right">
                                <span style="color: blue;">{{ number_format($players[$i]->buy_price, 0, ",", ".") }}</span>
                            </td>
                            <td class="align-middle text-right">
                                <span style="color: dodgerblue;">{{ number_format($players[$i]->sell_price, 0, ",", ".") }}</span>
                            </td>
                            @if($players[$i]->sell_price != 0)
                                <td class="align-middle text-right">
                                    <span style="color: {{ $players[$i]->profit < 0 ? "#ff0000" : "#2ca02c" }};">{{ number_format($players[$i]->profit, 0, ",", ".") }}</span>
                                </td>
                            @else
                                <td class="align-middle text-right">{{ "-" }}</td>
                            @endif
                        </tr>
                    @endfor
                    </tbody>
                </table>
                {{ $players->links() }}
            </div>
        </div>
    </div>
@endsection

