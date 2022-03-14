<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;
use App\Models\RaidRoster;
use App\Models\User;
use App\Models\Wowclass;
use App\Models\Spec;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Definition of class & corresponding color used for seeding
        $class_data = array();
        $class_data[] = array("Death Knight",   "#C41F3B");
        $class_data[] = array("Druid",          "#FF7D0A");
        $class_data[] = array("Hunter",         "#ABD473");
        $class_data[] = array("Mage",           "#69CCF0");
        $class_data[] = array("Monk",           "#00FF96");
        $class_data[] = array("Paladin",        "#F58CBA");
        $class_data[] = array("Priest",         "#FFFFFF");
        $class_data[] = array("Rogue",          "#FFF569");
        $class_data[] = array("Shaman",         "#0070DE");
        $class_data[] = array("Warlock",        "#9482C9");
        $class_data[] = array("Warrior",        "#C79C6E");

        // Definition of specc-slug used for seeding - string corresponds to icon names
        $specc_data = array();
        $specc_data[] = array("death-knight-blood",  "death-knight-frost",  "death-knight-unholy");
        $specc_data[] = array("druid-balance", "druid-feral-bear", "druid-restoration");
        $specc_data[] = array("hunter-beast-mastery",  "hunter-marksmanship",  "hunter-survival");
        $specc_data[] = array("mage-arcane", "mage-fire", "mage-frost");
        $specc_data[] = array("monk-brewmaster", "monk-mistweaver", "monk-windwalker");
        $specc_data[] = array("paladin-holy", "paladin-protection", "paladin-retribution");
        $specc_data[] = array("priest-discipline", "priest-holy", "priest-shadow");
        $specc_data[] = array("rogue-assassination", "rogue-combat", "rogue-subtlety");
        $specc_data[] = array("shaman-elemental-combat", "shaman-enhancement", "shaman-restoration");
        $specc_data[] = array("warlock-affliction", "warlock-demonology", "warlock-destruction");
        $specc_data[] = array("warrior-arms", "warrior-fury", "warrior-protection");

        // Definition of buffs used for seeding
        //                      NAME                    EFFECT                 REQUIRED SPECC
        $buff_data[] = array("Trueshot Aura",   "+10% Attack Power",                3);
        $buff_data[] = array("Horn of Winter",  "+10% Attack Power",                1);
        $buff_data[] = array("Battle Shout",    "+10% Attack Power",                11);
        $buff_data[] = array("Unholy Aura",     "+10% Attack Speed",                3);
        $buff_data[] = array("Trueshot Aura",   "+10% Spell Power",                 3);
        $buff_data[] = array("Trueshot Aura",   "+5% Critical Strike Chance",       3);
        $buff_data[] = array("Trueshot Aura",   "+3000 Mastery Rating",             3);
        $buff_data[] = array("Trueshot Aura",   "+5% Strength, Agility, Intellect", 3);
        $buff_data[] = array("Trueshot Aura",   "+5% Spell Haste",                  3);
        $buff_data[] = array("Trueshot Aura",   "+10% Stamina",                     3);

        // factory one of every class
        $arr_length = count($class_data);
        for ($i = 0; $i < $arr_length; $i++) {
            Wowclass::factory()->create([
                'name'  =>  $class_data[$i][0],
                'color' =>  $class_data[$i][1]
            ]);
        }
        print("Seeded: Wowclass" . chr(10));

        // factory one of every specc
        $arr_length = count($specc_data);
        for ($i = 0; $i < $arr_length; $i++) {
            for ($j = 0; $j < 3; $j++) {
                Spec::factory()->create([
                    'name'  =>  $specc_data[$i][$j],
                    'wowclass_id'  =>  $i + 1
                ]);
            }
        }
        print("Seeded: Spec" . chr(10));

        // $x = count($class_data) for one of every class
        $x = count($class_data);
        // $y = 10 -> simulated bench
        $y = 10;
        $z = $x + $y;

        // factory x+y characters
        for ($i = 0; $i < $z; $i++) {
            if ($i < $x) {                      /* first 10 characters -> create unique classes */
                $randomClass = ($i + 1) * 3;    /* 3 speccs per class -> multiply by three */
            } else {                            /* fill with random classes */
                $randomClass = rand(1, 11) * 3;
            }
            $randomMainSpecc = rand(0, 2);
            $randomOffSpecc = rand(0, 2);

            /* Make sure we don't duplicate speccs while seeding */
            while ($randomOffSpecc == $randomMainSpecc) {
                $randomOffSpecc = rand(0, 2);
            }

            /* since we multiplied by three, subtract the specc value */
            Character::factory()->create([
                'ms_id'  =>  $randomClass - $randomMainSpecc,
                'os_id' =>   $randomClass - $randomOffSpecc,
            ]);
        }
        print("Seeded: Character" . chr(10));

        /* factory x active characters to raidroster */
        RaidRoster::factory(10)->create([
            'buff_assigned' => 0,
            'is_backup' => 0,
        ]);

        /* factory x backup characters to raidroster */
        RaidRoster::factory(5)->create([
            'buff_assigned' => 0,
            'is_backup' => 1,
        ]);
        print("Seeded: RaidRoster" . chr(10));
    }
}
