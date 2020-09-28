<?php

use App\Models\Catalog\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            [
                'name_ru' => 'Home',
                'name_en' => 'Главная',
                'url' => '/',
                'page_type' => 'home',
                'page_up' => 0,
            ],
            [
                'name_ru' => 'Catalog',
                'name_en' => 'Каталог',
                'url' => 'catalog',
                'page_type' => 'catalog',
                'page_up' => 1,
            ],
            [
                'name_ru' => 'Поставщики',
                'name_en' => 'Suppliers',
                'url' => 'suppliers',
                'page_type' => 'suppliers',
                'page_up' => 2,
            ],
            [
                'name_ru' => 'О компании',
                'name_en' => 'About company',
                'url' => 'about',
                'page_type' => 'about',
                'page_up' => 3,
            ],
        ];

        foreach ($menu as $menu) {
            Menu::create($menu);
        }

        $categories = [
            [
                'parent_id' => 0,
                'name_ru' => 'Женщинам',
                'url' => 'zhencschinam-1',
                'page_up' => 2,
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Верхняя одежда',
                'url' => 'verhnyaya_odezhda-2',
                'page_up' => 1,
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Куртки',
                'url' => 'kurtki-3',
                'page_up' => 1,
            ],
            [
                'parent_id' => 0,
                'name_ru' => 'Мужчина',
                'url' => 'muzhchinam-4',
                'page_up' => 1,
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Верхняя одежда',
                'url' => 'verhnyaya_odezhda-5',
                'page_up' => 1,
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Пальто',
                'url' => 'palto-6',
                'page_up' => 1,
            ],
           
        ];

        foreach ($categories as $categories) {
            Category::create($categories);
        }
    }
}
