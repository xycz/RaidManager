<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Wowclass::class, 'wowclass_id');
    }

    public function player()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ms()
    {
        return $this->belongsTo(Spec::class, 'ms_id');
    }

    public function os()
    {
        return $this->belongsTo(Spec::class, 'os_id');
    }
}
