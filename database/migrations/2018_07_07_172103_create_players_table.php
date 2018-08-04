<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('rating');
            $table->string('position');
            $table->string('cardtype');
            $table->string('player_img_link')->default("https://timebook.life/wp-content/uploads/2016/03/No-Content.png");
            $table->string('nation_img_link')->default("https://timebook.life/wp-content/uploads/2016/03/No-Content.png");
            $table->string('club_img_link')->default("https://timebook.life/wp-content/uploads/2016/03/No-Content.png");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
