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
                        Edit trade
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('trades.edit', ['id' => $trade->id]) }}">
                        {{ csrf_field() }}

                        <!-- PLAYER -->
                            <div class="form-row form-group">
                                <label for="inputPlayer" class="col-md-3 col-form-label">Player</label>
                                <label for="inputPlayer" class="col-md-9 col-form-label"><a
                                            href="{{ route("players.view", ['id' => $trade->player->id]) }}">{{ $trade->player->name }}</a>
                                </label>
                            </div>

                            <!-- BUY PRICE -->
                            <div class="form-row form-group">
                                <label for="inputBuy" class="col-md-3 col-form-label">Buy Price</label>
                                <div class="col-md-9 input-group">
                                    <input type="number" id="inputBuy" name="buy_price" class="form-control"
                                           placeholder="Buy Price"
                                           value="{{ old('buy_price') != "" ? old('buy_price') : $trade->buy_price }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Coins</span>
                                    </div>
                                </div>
                            </div>

                            <!-- SELL PRICE -->
                            <div class="form-row form-group">
                                <label for="inputSell" class="col-md-3 col-form-label">Sell Price</label>
                                <div class="col-md-9 input-group">
                                    <input type="number" id="inputSell" name="sell_price" class="form-control"
                                           placeholder="Sell Price"
                                           value="{{ old('sell_price') != "" ? old('sell_price') : $trade->sell_price }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Coins</span>
                                    </div>
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
                                    <a href="{{ route('trades.index') }}"
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