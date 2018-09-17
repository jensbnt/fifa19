<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /** INDEX */

    public function getTeamsIndex()
    {
        $teams = Team::all();

        return view('teams.index', ['teams' => $teams]);
    }

    /** VIEW */

    public function getTeamsView($id, Request $request)
    {
        /* Set starting values */
        $paginate = 30;

        /* Find team */
        $team = Team::find($id);

        if ($team == null) {
            $error = "No team with this id";
            return view('home.error', ['error' => $error]);
        }

        /* Make query */
        $query = TeamPlayer::join('players', 'team_players.player_id', '=', 'players.id')
            ->select('players.*', 'team_players.id as team_player_id', 'team_players.games', 'team_players.goals', 'team_players.assists', DB::raw("ROUND((team_players.goals + team_players.assists) / team_players.games, 3) as ctr"))
            ->where('team_id', '=', $id);

        if (!$request->has('sort') || $request->input('sort') == "m") {
            $query->orderBy('games', 'desc')
                ->orderBy('ctr', 'desc');
        } else if ($request->input('sort') == "g") {
            $query->orderBy('goals', 'desc')
                ->orderBy('ctr', 'desc');
        } else if ($request->input('sort') == "a") {
            $query->orderBy('assists', 'desc')
                ->orderBy('ctr', 'desc');
        } else if ($request->input('sort') == "c") {
            $query->orderBy('ctr', 'desc')
                ->orderBy('games', 'desc');
        }

        $players = $query->paginate($paginate);

        return view('teams.view', ['team' => $team, 'players' => $players]);
    }

    public function postTeamsView($id, Request $request)
    {
        if ($request->has('teamplayerid')) {
            return $this->deleteFromTeam($id, $request->input('teamplayerid'));
        } else if ($request->has('delete')) {
            return $this->deleteTeam($id);
        } else {
            return redirect()->refresh()->with('fail', "Please select a player to delete");
        }
    }

    private function deleteFromTeam($teamid, $teamplayerid)
    {
        $teamplayer = TeamPlayer::find($teamplayerid);
        $teamplayer->delete();

        return redirect()->route('teams.view', ['id' => $teamid])->with('info', $teamplayer->player->name . " deleted from team");
    }

    private function deleteTeam($id)
    {
        $team = Team::find($id);
        $team->delete();

        TeamPlayer::where('team_id', $id)->delete();

        return redirect()->route('teams.index')->with('info', $team->name . " deleted");
    }

    /** EDIT */

    public function getTeamsEdit($id)
    {
        $team = Team::find($id);

        if ($team == null) {
            $error = "No team with this id";
            return view('home.error', ['error' => $error]);
        }

        return view('teams.edit', ['team' => $team]);
    }

    public function postTeamsEdit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'clubImage' => 'required',
        ]);

        $team = Team::find($id);
        $team->name = $request->input('name');
        $team->description = $request->input('description');
        $team->club_img_link = $request->input('clubImage');
        $team->save();

        return redirect()->route('teams.view', ['id' => $team->id])->with('info', $team->name . " updated");
    }

    /** CREATE */

    public function getTeamsCreate()
    {
        return view('teams.create');
    }

    public function postTeamsCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'clubImage' => 'required',
        ]);

        $team = new Team([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'club_img_link' => $request->input('clubImage'),
        ]);
        $team->save();

        return redirect()->route('teams.view', ['id' => $team->id])->with('info', $team->name . " created");
    }

    /** PLAYER */

    public function getTeamPlayerView($id)
    {
        $teamplayer = TeamPlayer::find($id);

        if ($teamplayer == null) {
            $error = "No teamplayer with this id";
            return view('home.error', ['error' => $error]);
        }

        return view('teams.player', ['teamplayer' => $teamplayer]);
    }

    public function postTeamPlayerView($id, Request $request)
    {
        $this->validate($request, [
            'games' => 'required|numeric|min:0',
            'goals' => 'required|numeric|min:0',
            'assists' => 'required|numeric|min:0',
        ]);

        $teamplayer = TeamPlayer::find($id);
        $teamplayer->games = $request->input('games');
        $teamplayer->goals = $request->input('goals');
        $teamplayer->assists = $request->input('assists');
        $teamplayer->save();

        return redirect()->route('teams.view', ['id' => $teamplayer->team->id])->with('info', $teamplayer->player->name . " updated");
    }

    /** GAME */

    public function getTeamGameView($id)
    {
        $team = Team::find($id);

        if ($team == null) {
            $error = "No team with this id";
            return view('home.error', ['error' => $error]);
        }

        return view('teams.game', ['team' => $team]);
    }

    public function postTeamGameView($id, Request $request)
    {
        if ($request->has('checked')) {
            foreach ($request->input('checked') as $teamplayer_id) {
                $teamplayer = TeamPlayer::find($teamplayer_id);
                $teamplayer->games += 1;
                $teamplayer->goals += $request->input('goals' . $teamplayer_id);
                $teamplayer->assists += $request->input('assists' . $teamplayer_id);
                $teamplayer->save();
            }
        }

        return redirect()->route('teams.view', ['id' => $id])->with('info', "New game added");
    }
}
