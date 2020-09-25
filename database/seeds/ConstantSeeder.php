<?php

use App\Models\Constants\Constants;
use Illuminate\Database\Seeder;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constants = [
            [
                'name' => 'EMAIL',
                'category_id' => 3,
                'description' => 'Email для уведомления (через запятую)',
                'editor' => '',
            ],
            [
                'name' =>'RUB',
                'category_id' => 7,
                'description' => 'Символ рубля',
                'editor' => '',
            ],
            [
                'name' =>'FB',
                'category_id' => 7,
                'description' => 'Facebook',
                'editor' => '',
            ],
            [
                'name' =>'INSTA',
                'category_id' => 7,
                'description' => 'Insta',
                'editor' => '',
            ],
            [
                'name' =>'YOUTUBE',
                'category_id' => 7,
                'description' => 'Youtube',
                'editor' => '',
            ],
            [
                'name' =>'PHONE',
                'category_id' => 3,
                'description' => 'Телефоны для контактов',
                'editor' => '',
            ],
            [
                'name' =>'SUPPORT_DESC',
                'category_id' => 9,
                'description' => 'Текст службы поддержки в статистике у поставщика',
                'editor' => '',
            ],
        ];
        foreach ($constants as $constants) {
            Constants::create($constants);
        }
    }
}
