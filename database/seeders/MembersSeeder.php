<?php

namespace Database\Seeders;

use App\Enums\GuildPosition;
use App\Enums\Permissions;
use App\Enums\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usernames = [
            'yurusaki',
            'Frostfire',
            'darkrok',
            'Garza',
            'SimonSxr',
            'Andre',
            'Nato',
            'Kurochi',
            'Lotus',
            'REVEL',
            'Sesame',
            'Verithias',
            'Chiring',
            'AceOfHeart',
            'Akashi',
            'tr0uble',
            'Zer0',
            'Kotsuko',
            'Jun',
            'Swayin',
            'KKyle',
            'Cephina',
            'Bodyr',
            'Neve',
            'Ragebait',
            'Yk',
            'Nox',
            'Crocasmicus',
            'Kalona',
            'xJoyBoy',
            'Crisco',
            'Byeukadayo',
            'Sentiment',
            'Jinrang',
            'Papaflash',
            'Puppey',
            'Raikirituga',
            'Solobolo',
            'Hete',
            'Gadeth',
            'Sohain',
            'K1ller',
            'Sychros',
            'RiceCakes',
            'Rave',
            'Ciompas',
            'Lanjiao',
            'Eriku',
            'Grey',
        ];

        $data = [];

        foreach ($usernames as $username) {
            $data[] = [
                'username' => $username,
                'guild_attribution' => 'Dragons',
                'role' => GuildPosition::Member,
                'permission' => Permissions::None,
                'status' => Status::Active,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('members')->insert($data);
    }
}
