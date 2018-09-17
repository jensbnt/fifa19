<?php

namespace App\Http\Controllers;

use App\Player;
use App\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /** HOME INDEX */

    public function getHomeIndex()
    {
        $players = TeamPlayer::select('players.name', 'teams.name as teamname', 'team_players.goals')
            ->leftJoin('players', 'team_players.player_id', 'players.id')
            ->leftJoin('teams', 'team_players.team_id', 'teams.id')
            ->orderBy('team_players.updated_at')
            ->limit(10)
            ->get();

        return view('home.index', ['players' => $players]);
    }

    /** CREATE INDEX */

    public function getCreateIndex()
    {
        return view('create.index');
    }

    /** STATS INDEX */

    public function getStatsIndex(Request $request)
    {
        /* Set starting values */
        $paginate = 30;
        $limit = 30;

        /* Make query */
        if (!$request->has('sort') || $request->input('sort') == "m") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('games', 'desc')
                ->orderBy('ctr', 'desc');
        } else if ($request->input('sort') == "g") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('goals', 'desc')
                ->orderBy('ctr', 'desc');
        } else if ($request->input('sort') == "a") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('assists', 'desc')
                ->orderBy('ctr', 'desc');
        } else if ($request->input('sort') == "c") {
            $query = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('ctr', 'desc')
                ->orderBy('games', 'desc');
        }

        /* Get players */
        $players = $query->limit($limit)
            ->paginate($paginate);;

        return view('stats.index', ['players' => $players]);
    }
}
