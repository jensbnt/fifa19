<?php

namespace App\Http\Controllers;

use App\Car;
use App\Player;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /** PLAYERS API */

    public function apiPlayersIndex()
    {
        $players = Player::all();

        return response()->json($players, 200);
    }

    public function apiPlayersGet($name)
    {
        $players = Player::where('name', 'LIKE', $name . "%")
            ->limit(10)
            ->get();

        return response()->json($players, 200);
    }
}
