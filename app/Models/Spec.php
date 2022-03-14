<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Wowclass::class, 'wowclass_id');
    }
}
