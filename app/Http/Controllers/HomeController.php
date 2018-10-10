<?php

namespace App\Http\Controllers;

use App\Player;
use App\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /** HOME INDEX */

    public function getHomeIndex(Request $request)
    {
        /* Set starting values */
        $paginate = 30;

        /* Make query */
        if (!$request->has('sort') || $request->input('sort') == "m") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('games', 'desc');
        } else if ($request->input('sort') == "g") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('goals', 'desc');
        } else if ($request->input('sort') == "a") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('assists', 'desc');
        } else if ($request->input('sort') == "c") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('ctr', 'desc');
        }

        /* Get players */
        $players = $query->orderBy('ctr', 'desc')
            ->orderBy('name', 'asc')
            ->paginate($paginate);

        return view('home.index', ['players' => $players->appends($request->except('page'))]);
    }

    /** HOME ABOUT */

    public function getHomeAbout()
    {
        return view('home.about');
    }

    /** CREATE INDEX */

    public function getCreateIndex()
    {
        return view('create.index');
    }
}
