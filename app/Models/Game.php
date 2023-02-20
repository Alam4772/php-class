<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function studentGame()
    {
        return $this->hasMany(StudentGame::class, 'game_id', 'id');
    }
}
