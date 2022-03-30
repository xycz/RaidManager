<?php

use Illuminate\Support\Facades\Route;
use App\Models\Character;
use App\Models\Wowclass;
use App\Models\RaidRoster;
use App\Models\Buff;
use App\Models\Effect;
use App\Http\Controllers\CharacterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('updateRoster/', [CharacterController::class, 'update'])->middleware(['auth']);

Route::get('/', function () {

    return view('main', [
        'characters' => Character::with('class', 'player')->get(),
        'availableCharacters' => Character::all(),
        'classes' => Wowclass::all(),
        'raidRoster' => RaidRoster::with('character')->get(),
        'buffs' => Buff::all(),
        'effects' => Effect::all(),
    ]);

})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


