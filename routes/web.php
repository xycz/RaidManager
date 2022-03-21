<?php

use Illuminate\Support\Facades\Route;
use App\Models\Character;
use App\Models\Wowclass;
use App\Models\RaidRoster;
use App\Models\Buff;
use App\Models\Effect;
use App\Http\Controllers\CharacterController;

/* REFACTOR TO CONTROLLERS WHEN NEEDED */

Route::get('/', function () {

    return view('main', [
        'characters' => Character::with('class', 'player')->get(),
        'availableCharacters' => Character::all(),
        'classes' => Wowclass::all(),
        'raidRoster' => RaidRoster::with('character')->get(),
        'buffs' => Buff::all(),
        'effects' => Effect::all(),
    ]);

})->name('home');

Route::post('updateRoster/', [CharacterController::class, 'update']);