<?php

use App\Models\ProfileMenu;
use Illuminate\Database\Seeder;

class ProfileMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profileMenu = [
            [
                'name_ru' => 'Рабочая область',
                'description' => '',
                'icon' => '<i class="mdi mdi-home menu-icon"></i>',
                'route' => 'workspace',
                'page_up' => 0,
            ],
            [
                'name_ru' => 'История зачислений',
                'description' => '',
                'icon' => '<i class="mdi mdi-chart-line menu-icon"></i>',
                'route' => 'enrollment',
                'page_up' => 2,
            ],
            [
                'name_ru' => 'Мой баланс',
                'description' => '',
                'icon' => '<i class="mdi mdi-currency-usd menu-icon"></i>',
                'route' => 'ballance',
                'page_up' => 4,
            ],
            [
                'name_ru' => 'Мой профиль',
                'description' => '',
                'icon' => '<i class="mdi mdi-account menu-icon"></i>',
                'route' => 'account',
                'page_up' => 6,
            ],
            [
                'name_ru' => 'Связаться с нами',
                'description' => '',
                'icon' => '<i class="mdi mdi-phone-in-talk menu-icon"></i>',
                'route' => 'contact',
                'page_up' => 7,
            ],
            [
                'name_ru' => 'Мои официанты',
                'description' => '',
                'icon' => '<i class="mdi mdi-human-male menu-icon"></i>',
                'route' => 'my_oficiants',
                'page_up' => 5,
            ],
            [
                'name_ru' => 'Мои рефералы',
                'description' => '',
                'icon' => '<i class="mdi mdi-human-male menu-icon"></i>',
                'route' => 'my_referrals',
                'page_up' => 1,
            ],
            [
                'name_ru' => 'История зачислений',
                'description' => 'для партнеров',
                'icon' => '<i class="mdi mdi-chart-line menu-icon"></i>',
                'route' => 'partner_enrollment',
                'page_up' => 3,
            ],
        ];
        foreach ($profileMenu as $profileMenu) {
            ProfileMenu::create($profileMenu);
        }
    }
}
