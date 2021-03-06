<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buff extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function effect()
    {
        return $this->belongsTo(Effect::class, 'id');
    }
}

