<?php

use App\Models\ProfileMenuGuard;
use Illuminate\Database\Seeder;

class ProfileMenuGuardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profileMenuGuard = [
            [
                'menu_id' => 1,
                'type' => 'user'
            ],
            [
                'menu_id' => 1,
                'type' => 'admin'
            ],
            [
                'menu_id' => 7,
                'type' => 'agent'
            ],
            [
                'menu_id' => 2,
                'type' => 'user'
            ],
            [
                'menu_id' => 2,
                'type' => 'admin'
            ],
            [
                'menu_id' => 8,
                'type' => 'agent'
            ],
            [
                'menu_id' => 3,
                'type' => 'user'
            ],
            [
                'menu_id' => 3,
                'type' => 'admin'
            ],
            [
                'menu_id' => 3,
                'type' => 'agent'
            ],
            [
                'menu_id' => 6,
                'type' => 'admin'
            ],
            [
                'menu_id' => 4,
                'type' => 'user'
            ],
            [
                'menu_id' => 4,
                'type' => 'admin'
            ],
            [
                'menu_id' => 4,
                'type' => 'agent'
            ],
            [
                'menu_id' => 5,
                'type' => 'user'
            ],
            [
                'menu_id' => 5,
                'type' => 'admin'
            ],
            [
                'menu_id' => 5,
                'type' => 'agent'
            ],
       
       ];

        foreach ($profileMenuGuard as $profileMenuGuard) {
            ProfileMenuGuard::create($profileMenuGuard);
        }
    }
}
