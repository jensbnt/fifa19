<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = ['id', 'player_id', 'buy_price', 'sell_price'];

    public function player()
    {
        return $this->belongsTo('\App\Player', 'player_id', 'id');
    }
}
