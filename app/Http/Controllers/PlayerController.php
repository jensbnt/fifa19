<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    /** INDEX */

    public function getPlayersIndex(Request $request)
    {
        /* Set starting values */
        $paginate = 30;

        /* Make query */
        if ($request->input('display') == "t") {
            $query = TeamPlayer::select('players.*')
                ->join('players', 'team_players.player_id', '=', 'players.id')
                ->groupBy('players.id');
        } else {
            $query = Player::select('players.*');
        }

        if ($request->input('name') != "")
            $query->where('name', 'LIKE', "%" . $request->input('name') . "%");

        if ($request->input('position') != "")
            $query->where('position', 'LIKE', $request->input('position') . "%");

        if ($request->input('cardtype') != "")
            $query->where('cardtype', 'LIKE', $request->input('cardtype') . "%");

        if ($request->input('minRating') != "")
            $query->where('rating', '>=', $request->input('minRating') + 0);

        if ($request->input('maxRating') != "")
            $query->where('rating', '<=', $request->input('maxRating') + 0);

        switch ($request->input('sort')) {
            case 'n':
                $query->orderBy('name');
                break;
            case 'p':
                $query->orderBy('position');
                break;
            case 't':
                $query->orderBy('cardtype');
                break;
            default:
                $query->orderBy('rating', 'desc');
                break;
        }

        $players = $query->paginate($paginate);

        /* Get positions */
        $positions = Player::select('position')
            ->groupBy('position')
            ->get();

        /* Get card types */
        $cardtypes = Player::select('cardtype')
            ->groupBy('cardtype')
            ->get();

        return view('players.index', ['players' => $players->appends($request->except('page')), 'positions' => $positions, 'cardtypes' => $cardtypes]);
    }

    /** VIEW */

    public function getPlayersView($id)
    {
        $player = Player::leftJoin('team_players', 'players.id', 'team_players.player_id')
            ->select('players.*', DB::raw("SUM(team_players.games) as total_games, SUM(team_players.goals) as total_goals, SUM(team_players.assists) as total_assists, (SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games) as total_ctr"))
            ->groupBy('players.id')
            ->where('players.id', '=', $id)
            ->first();

        if ($player == null) {
            $error = "No player with this id";
            return view('home.error', ['error' => $error]);
        }

        $teams = Team::all();

        return view('players.view', ['player' => $player, 'teams' => $teams]);
    }

    public function postPlayersView($id, Request $request)
    {
        if ($request->has('teamid')) {
            return $this->addToTeam($id, $request);
        } else if ($request->has('delete')) {
            return $this->deletePlayer($id);
        } else {
            return redirect()->refresh()->with('fail', "Please select a player to add");
        }
    }

    private function addToTeam($playerid, $request)
    {
        $this->validate($request, [
            'teamid' => 'required',
        ]);
        $teamid = $request->input('teamid');

        /* Test if player is already on team */
        $teamplayer = TeamPlayer::where('player_id', $playerid)
            ->where('team_id', $teamid)
            ->first();

        if ($teamplayer != null)
            return redirect()->route('players.view', ['id' => $playerid])->with('info', "This player is already on this team");

        /* Test ID's */
        $player = Player::find($playerid);
        $team = Team::find($teamid);

        /* Add player */
        $teamplayer = new TeamPlayer([
            'team_id' => $teamid,
            'player_id' => $playerid,
        ]);
        $teamplayer->save();

        return redirect()->route('players.view', ['id' => $playerid])->with('info', $player->name . " added to " . $team->name);
    }

    private function deletePlayer($id)
    {
        $player = Player::find($id);
        $player->delete();

        TeamPlayer::where('player_id', $id)->delete();

        return redirect()->route('players.index')->with('info', $player->name . " deleted");
    }

    /** EDIT */

    public function getPlayersEdit($id)
    {
        $player = Player::find($id);

        return view('players.edit', ['player' => $player]);
    }

    public function postPlayersEdit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'rating' => 'required|numeric|min:0|max:99',
            'position' => 'required',
            'cardtype' => 'required',
            'playerImage' => 'required',
            'nationImage' => 'required',
            'clubImage' => 'required',
        ]);

        $player = Player::find($id);

        if ($player == null) {
            $error = "No player with this id";
            return view('home.error', ['error' => $error]);
        }

        $player->name = $request->input('name');
        $player->rating = $request->input('rating');
        $player->position = $request->input('position');
        $player->cardtype = $request->input('cardtype');
        $player->player_img_link = $request->input('playerImage');
        $player->nation_img_link = $request->input('nationImage');
        $player->club_img_link = $request->input('clubImage');
        $player->save();

        return redirect()->route('players.view', ['id' => $id])->with('info', $player->name . " updated");
    }

    /** CREATE */

    public function getPlayersCreate()
    {
        return view('players.create');
    }

    public function postPlayersCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'rating' => 'required|numeric|min:0|max:99',
            'position' => 'required',
            'cardtype' => 'required',
            'playerImage' => 'required',
            'nationImage' => 'required',
            'clubImage' => 'required',
        ]);

        $player = new Player([
            'name' => $request->input('name'),
            'rating' => $request->input('rating'),
            'position' => $request->input('position'),
            'cardtype' => $request->input('cardtype'),
            'player_img_link' => $request->input('playerImage'),
            'nation_img_link' => $request->input('nationImage'),
            'club_img_link' => $request->input('clubImage'),
        ]);
        $player->save();

        return redirect()->route('players.view', ['id' => $player->id])->with('info', $player->name . " created");
    }

    /** FILE */

    public function getPlayersFileCreate()
    {
        return view('players.file');
    }

    public function postPlayersFileCreate(Request $request)
    {
        $file = $request->file('file');

        if (!$file->isValid())
            dd('invalid');

        $errors = 0;
        $playercount = 0;

        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                try {
                    if (count($data) != 7) {
                        throw new \Exception("Illegal number of arguments");
                    } elseif (!is_numeric($data[1])) {
                        throw new \Exception("Illegal argument: rating");
                    } else {
                        $playercount++;
                        $player = new Player([
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'name' => $data[0],
                            'rating' => $data[1],
                            'position' => $data[2],
                            'cardtype' => $data[3],
                            'player_img_link' => $data[4],
                            'nation_img_link' => $data[5],
                            'club_img_link' => $data[6],
                            'seeded' => 0
                        ]);
                        $player->save();
                    }
                } catch (\Exception $exception) {
                    $errors++;
                }
            }
            fclose($handle);
        }

        return redirect()->route('players.index')->with('info', "Bulk completed: " . $playercount . " created, " . $errors . " failed");
    }
}
