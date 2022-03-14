<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaidRoster extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function backup()
    {
        return $this->belongsTo(Character::class, 'is_backup');
    }

    public function assigned()
    {
        return $this->belongsTo(Character::class, 'buff_assigned');
    }
}
