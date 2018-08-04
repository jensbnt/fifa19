<?php

use App\Team;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $team = new Team([
                'name' => "Test Team " . ($i + 1),
                'description' => 'This is a seeded team, used to test teams on FIFA 19.',
            ]);
            $team->save();
        }
    }
}
