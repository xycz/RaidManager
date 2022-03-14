<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wowclass extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function characters()
    {
        return $this->hasOne(Wowclass::class);
    }
}
