<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;
use App\Models\RaidRoster;
use App\Models\Wowclass;
use App\Models\Spec;
use App\Models\Buff;
use App\Models\Effect;

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
        $class_data = $this->generateClassArray();

        // Definition of specc-slug used for seeding - string corresponds to icon names
        $specc_data = $this->generateSpeccArray();

        // Definition of effects used for seeding
        $effect_data = $this->generateEffectArray();

        // Definition of buffs used for seeding
        $buff_data = $this->generateBuffArray();


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

        $arr_length = count($effect_data);
        for($i=0; $i<$arr_length; $i++)
        {
            Effect::factory()->create([
                'name' => $effect_data[$i][0],
                'slug' => $effect_data[$i][1]
            ]);
        }
        print("Seeded: Effects" . chr(10));

        $arr_length = count($buff_data);
        for($i=0; $i<$arr_length; $i++)
        {
            Buff::factory()->create([
                'name' => $buff_data[$i][0],
                'effect' => $buff_data[$i][1],
                'req_specc' => $buff_data[$i][2],
                'req_class' => $buff_data[$i][3],
            ]);
        }
        print("Seeded: Buffs" . chr(10));
    }

    public function generateClassArray()
    {
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

        return $class_data;
    }

    public function generateSpeccArray()
    {
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

        return $specc_data;
    }

    public function generateEffectArray()
    {
        
        $effect_data = array();
        /*                      NAME                    SLUG          */
        $effect_data[] = array("+10% Attack Power",                 "inv_misc_horn_02");
        $effect_data[] = array("+10% Attack Speed",                 "inv_helmet_08");
        $effect_data[] = array("+10% Spell Power",                  "spell_holy_magicalsentry");
        $effect_data[] = array("+5% Critical Strike Chance",        "ability_monk_prideofthetiger");
        $effect_data[] = array("+3000 Mastery Rating",              "spell_holy_greaterblessingofkings");
        $effect_data[] = array("+5% Strength, Agility, Intellect",  "spell_magic_greaterblessingofkings");
        $effect_data[] = array("+5% Spell Haste",                   "spell_shadow_spectralsight");
        $effect_data[] = array("+10% Stamina",                      "spell_holy_wordfortitude");

        return $effect_data;
    }

    public function generateBuffArray()
    {
        /* Hunter alternative pets currently commented out */
        $buff_data = array();
        /*                      NAME                    EFFECT                    SPECC     CLASS*/
        $buff_data[] = array("Trueshot Aura",           1,        null,   3);
        $buff_data[] = array("Horn of Winter",          1,        null,   1);
        $buff_data[] = array("Battle Shout",            1,        null,   11);

        $buff_data[] = array("Unholy Aura",             2,        2,      null);
        $buff_data[] = array("Unholy Aura",             2,        3,      null);
        $buff_data[] = array("Swiftblade's Cunning",    2,        null,   8);
        $buff_data[] = array("Unleashed Rage",          2,        26,     null);
        $buff_data[] = array("Cackling Howl",           2,        null,   3);
        /* $buff_data[] = array("Serpent's Swiftness",     1,        null,   3); */

        $buff_data[] = array("Arcane Brilliance",       3,         null,   4);
        $buff_data[] = array("Dark Intent",             3,         null,   10);
        $buff_data[] = array("Burning Wrath",           3,         null,   9);
        $buff_data[] = array("Still Water",             3,         null,   3);

        $buff_data[] = array("Leader of the Pack",          4, 5, null);
        $buff_data[] = array("Arcane Brilliance",           4, null, 4);
        $buff_data[] = array("Legacy of the White Tiger",   4, 15, null);
        $buff_data[] = array("Furious Howl",                4, null, 3);
        /* $buff_data[] = array("Terrifying Roar",             4, null, 3); */
        /* $buff_data[] = array("Still Water",                 4, null, 3); */

        $buff_data[] = array("Grace of Air",            5,     null,   9);
        $buff_data[] = array("Blessing of Might",       5,     null,   6);
        $buff_data[] = array("Roar of Courage",         5,     null,   3);
        /* $buff_data[] = array("Spirit Beast Blessing",           5, null, 3); */

        $buff_data[] = array("Mark of the Wild",            6, null, 2);
        $buff_data[] = array("Blessing of Kings",           6, null, 6);
        $buff_data[] = array("Legacy of the Emperor",       6, null, 5);
        $buff_data[] = array("Embrace of the Shale Spider", 6, null, 3);

        $buff_data[] = array("Moonkin Aura",            7,          4,      null);
        $buff_data[] = array("Shadowform",              7,          21,     null);
        $buff_data[] = array("Elemental Oath",          7,          25,     null);
        $buff_data[] = array("Mind Quickening",         7,          null,   3);

        $buff_data[] = array("Power Word: Fortitude",   8,             null,   7);
        $buff_data[] = array("Dark Intent",             8,             null,   10);
        $buff_data[] = array("Commanding Shout",        8,             null,   11);
        $buff_data[] = array("Qiraji Fortitude",        8,             null,   3);

        return $buff_data;
    }
}
