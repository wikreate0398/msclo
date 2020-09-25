<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AdminUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrcreate([
            'email' => 'admin@admin.com',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'salt'  => '',
            'password' => Hash::make('admin'),
        ]);
        AdminUser::firstOrcreate([
            'email' => 'admin@admin.com',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'salt'  => '',
            'password' => Hash::make('admin'),
        ]);
    }
}
