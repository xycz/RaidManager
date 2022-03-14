<?php

use Illuminate\Support\Facades\Route;
use App\Models\Character;
use App\Models\Wowclass;
use App\Models\RaidRoster;
use App\Http\Controllers\CharacterController;

/* REFACTOR TO CONTROLLERS WHEN NEEDED */

Route::get('/', function () {

    return view('main', [
        'characters' => Character::with('class', 'player')->get(),
        'availableCharacters' => Character::all(),
        'classes' => Wowclass::all(),
        'raidRoster' => RaidRoster::with('character', 'backup', 'assigned')->get()
    ]);

})->name('home');

    return view('welcome');
});

Route::post('updateRoster/', [CharacterController::class, 'update']);
