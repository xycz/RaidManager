<?php

namespace App\Http\Controllers;

use App\Models\RaidRoster;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
        public function create()
        {
            /* YET TO BE IMPLEMENTED */
        }

        public function update()
        {
            $attributes = request()->validate([
                'id' => 'required|between:1,10',
                'character_id' => 'required|integer',
                'buff_assigned' => 'required|boolean',
                'is_backup' => 'required|boolean'
            ]);

            RaidRoster::where('id', $attributes['id'])->update(array(
                'character_id' => $attributes['character_id'],
                'buff_assigned' => $attributes['buff_assigned'],
                'is_backup' => $attributes['is_backup']
            ));

            return redirect('/');
        }
}
