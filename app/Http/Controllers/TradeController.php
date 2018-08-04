<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradeController extends Controller
{
    /** INDEX */

    public function getTradesIndex()
    {
        return view('trades.index');
    }
}
