<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AdminUser;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'provider@gmail.com',
            'name' => 'Provider',
            'type' => 'provider',
            'lastname' => 'admin',
            'password' => Hash::make('admin'),
            'active' => 1,
            'confirm' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::firstOrcreate([
            'email' => 'client@gmail.com',
            'name' => 'Client',
            'type' => 'user',
            'lastname' => 'admin',
            'password' => Hash::make('admin'),
            'active' => 1,
            'confirm' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        AdminUser::firstOrcreate([
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'type' => 'admin',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        AdminUser::firstOrcreate([
            'email' => 'manager@admin.com',
            'name' => 'Manager',
            'type' => 'manager',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
