<?php

namespace App\Http\Controllers;

use App\Player;
use App\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    /** INDEX */

    public function getTradesIndex(Request $request)
    {
        /* Set starting values */
        $paginate = 30;

        /* Make query */
        $query = Player::select('players.*', 'trades.id AS trade_id', 'trades.buy_price', 'trades.sell_price', DB::raw("trades.sell_price * 0.95 - trades.buy_price AS profit"))
            ->rightJoin('trades', 'players.id', 'trades.player_id');

        switch ($request->input('display')) {
            case 'm':
                $month_ago = Carbon::now()->subMonth(1);
                $query->where('trades.updated_at', '>', $month_ago);
                break;
            case 'a':
                break;
            case 'w':
            default:
                $week_ago = Carbon::now()->subWeek(1);
                $query->where('trades.updated_at', '>', $week_ago);
                break;
        }

        $players = $query->orderBy('trades.id')
            ->paginate($paginate);

        $total_buy = Trade::sum('buy_price');

        $total_sell = Trade::sum('sell_price');

        $total_profit = $total_sell * 0.95 - $total_buy;

        return view('trades.index', ['players' => $players->appends($request->except('page')), 'total_buy' => $total_buy, 'total_sell' => $total_sell, 'total_profit' => $total_profit]);
    }

    /** EDIT */

    public function getTradesEdit($id)
    {
        $trade = Trade::find($id);

        if ($trade == null) {
            $error = "No trade with this id";
            return view('home.error', ['error' => $error]);
        }

        return view('trades.edit', ['trade' => $trade]);
    }

    public function postTradesEdit($id, Request $request)
    {
        $this->validate($request, [
            'buy_price' => 'required',
            'sell_price' => 'required',
        ]);

        $trade = Trade::find($id);
        $trade->buy_price = $request->input('buy_price');
        $trade->sell_price = $request->input('sell_price');
        $trade->save();

        return redirect()->route('trades.index')->with('info', "Trade updated");
    }

    /** CREATE */

    public function getTradesCreate()
    {
        return view('trades.create');
    }
}
