<?php

use App\Models\Constants\ConstantsValue;
use Illuminate\Database\Seeder;

class ConstantValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constantValue = [
            [
                'lang' => 'ru',
                'constant_id' => 1,
                'value' => 'fleancu.daniel@yandex.ru',
            ],
            [
                'lang' =>'ru',
                'constant_id' => 2,
                'value' => '₽',
            ],
            [
                'lang' =>'ru',
                'constant_id' => 3,
                'value' => 'https://facebook.com',
            ],
            [
                'lang' =>'ru',
                'constant_id' => 4,
                'value' => 'https://www.instagram.com/',
            ],
            [
                'lang' =>'ru',
                'constant_id' => 5,
                'value' => 'https://www.youtube.com/',
            ],
            [
                'lang' =>'ru',
                'constant_id' => 6,
                'value' => '(800) 8001-8588, (0600) 874 548',
            ],
            [
                'lang' =>'ru',
                'constant_id' => 7,
                'value' => 'No Data',
            ],
        ];
        foreach ($constantValue as $constantValue) {
            ConstantsValue::create($constantValue);
        }
    }
}
