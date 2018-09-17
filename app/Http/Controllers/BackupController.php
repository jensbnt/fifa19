<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use App\TeamPlayer;
use App\Trade;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    /** INDEX */

    public function getBackupIndex()
    {
        return view('backup.index');
    }

    public function postBackupIndex(Request $request)
    {
        if ($request->has('backup-all')) {
            return $this->postBackupAll();
        } else if ($request->has('backup-players')) {
            return $this->postBackupPlayers();
        } else if ($request->has('backup-teams')) {
            return $this->postBackupTeams();
        } else if ($request->has('backup-teamplayers')) {
            return $this->postBackupTeamplayers();
        } else if ($request->has('backup-trades')) {
            return $this->postBackupTrades();
        } else if ($request->has('restore-all')) {
            return $this->postRestoreAll();
        } else if ($request->has('restore-players')) {
            return $this->postRestorePlayers();
        } else if ($request->has('restore-teams')) {
            return $this->postRestoreTeams();
        } else if ($request->has('restore-teamplayers')) {
            return $this->postRestoreTeamplayers();
        } else if ($request->has('restore-trades')) {
            return $this->postRestoreTrades();
        }
    }

    /** POST BACKUP FUNCTIONS */

    public function postBackupAll()
    {
        $this->backupPlayers();
        $this->backupTeams();
        $this->backupTeamplayers();
        $this->backupTrades();

        return redirect()->route('backup.index')->with('info', "Backup complete ♦ All");
    }

    public function postBackupPlayers()
    {
        $this->backupPlayers();

        return redirect()->route('backup.index')->with('info', "Backup complete ♦ Players");
    }

    public function postBackupTeams()
    {
        $this->backupTeams();

        return redirect()->route('backup.index')->with('info', "Backup complete ♦ Teams");
    }

    public function postBackupTeamplayers()
    {
        $this->backupTeamplayers();

        return redirect()->route('backup.index')->with('info', "Backup complete ♦ Teamplayers");
    }

    public function postBackupTrades()
    {
        $this->backupTrades();

        return redirect()->route('backup.index')->with('info', "Backup complete ♦ Trades");
    }

    /** POST RESTORE FUNCTIONS */

    public function postRestoreAll()
    {
        $this->restorePlayers();
        $this->restoreTeams();
        $this->restoreTeamplayers();
        $this->restoreTrades();

        return redirect()->route('backup.index')->with('info', "Restore complete ♦ All");
    }

    public function postRestorePlayers()
    {
        $this->restorePlayers();

        return redirect()->route('backup.index')->with('info', "Restore complete ♦ Players");
    }

    public function postRestoreTeams()
    {
        $this->restoreTeams();

        return redirect()->route('backup.index')->with('info', "Restore complete ♦ Teams");
    }

    public function postRestoreTeamplayers()
    {
        $this->restoreTeamplayers();

        return redirect()->route('backup.index')->with('info', "Restore complete ♦ Teamplayers");
    }

    public function postRestoreTrades()
    {
        $this->restoreTrades();

        return redirect()->route('backup.index')->with('info', "Restore complete ♦ Trades");
    }

    /** BACKUP FUNCTIONS */

    public function backupPlayers()
    {
        $file = public_path() . "/json/player-backup.json";
        $players = Player::all();
        file_put_contents($file, json_encode($players));
    }

    public function backupTeams()
    {
        $file = public_path() . "/json/team-backup.json";
        $teams = Team::all();
        file_put_contents($file, json_encode($teams));
    }

    public function backupTeamplayers()
    {
        $file = public_path() . "/json/teamplayer-backup.json";
        $teamplayers = TeamPlayer::all();
        file_put_contents($file, json_encode($teamplayers));
    }

    public function backupTrades()
    {
        $file = public_path() . "/json/trade-backup.json";
        $trades = Trade::all();
        file_put_contents($file, json_encode($trades));
    }

    /** RESTORE FUNCTIONS */

    public function restorePlayers()
    {
        $file = public_path() . "/json/player-backup.json";
        if (!file_exists($file)) {
            return false;
        }
        Player::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $player = new Player([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'name' => $item->name,
                'rating' => $item->rating,
                'position' => $item->position,
                'cardtype' => $item->cardtype,
                'player_img_link' => $item->player_img_link,
                'nation_img_link' => $item->nation_img_link,
                'club_img_link' => $item->club_img_link,
            ]);
            $player->save();
        }
    }

    public function restoreTeams()
    {
        $file = public_path() . "/json/team-backup.json";
        if (!file_exists($file)) {
            return false;
        }
        Team::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $team = new Team([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'name' => $item->name,
                'description' => $item->description,
                'club_img_link' => $item->club_img_link,
            ]);
            $team->save();
        }
    }

    public function restoreTeamplayers()
    {
        $file = public_path() . "/json/teamplayer-backup.json";
        if (!file_exists($file)) {
            return false;
        }
        TeamPlayer::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $teamplayer = new TeamPlayer([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'team_id' => $item->team_id,
                'player_id' => $item->player_id,
                'goals' => $item->goals,
                'assists' => $item->assists,
                'games' => $item->games,
            ]);
            $teamplayer->save();
        }
    }

    public function restoreTrades()
    {
        $file = public_path() . "/json/trade-backup.json";
        if (!file_exists($file)) {
            return false;
        }
        Trade::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $trade = new Trade([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'player_id' => $item->player_id,
                'buy_price' => $item->buy_price,
                'sell_price' => $item->sell_price,
            ]);
            $trade->save();
        }
    }
}
