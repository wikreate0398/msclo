<?php

use App\Models\Constants\ConstantsCategory;
use Illuminate\Database\Seeder;

class ConstantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constantsCategory = [
            [
            'name' => 'Подвал',
            'page_up' => '1',
            ],
            [
                'name' =>'Гиперссылки',
                'page_up' => '2',
            ],
            [
                'name' =>'Контакты',
                'page_up' => '3',
            ],
            [
                'name' =>'Метки',
                'page_up' => '4',
            ],
            [
                'name' =>'Заголовки',
                'page_up' => '5',
            ],
            [
                'name' =>'Кнопки',
                'page_up' => '6',
            ],
            [
                'name' =>'Другое',
                'page_up' => '7',
            ],
            [
                'name' =>'Описание',
                'page_up' => '8',
            ],
            [
                'name' =>'Ошибки',
                'page_up' => '9',
            ],
            [
                'name' =>'Уведомления',
                'page_up' => '10',
            ],
        ];
        foreach ($constantsCategory as $constantsCategory) {
            ConstantsCategory::create($constantsCategory);
        }
    }
}
