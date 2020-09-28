<?php

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTypes = [
            [
                'type' => 'admin',
                'name_ru' => 'Админ',
                'name_en' => 'Admin',
                'page_up' => 1,
            ],
            [
                'type' => 'user',
                'name_ru' => 'Клиент',
                'name_en' => 'Client',
                'page_up' => 2,
            ],
            [
                'type' => 'provider',
                'name_ru' => 'Поставщик',
                'name_en' => 'Provider',
                'page_up' => 3,
            ],
            [
                'type' => 'manager',
                'name_ru' => 'Менеджер',
                'name_en' => 'Manager',
                'page_up' => 4,
            ],
        ];

        foreach ($userTypes as $userType) {
            UserType::create($userType);
        }
    }
}
