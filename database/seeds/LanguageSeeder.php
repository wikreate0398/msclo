<?php

use App\Models\Languages;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'name' => 'Русский',
                'short' => 'ru',
                'page_up' => 1,
            ],
            [
                'name' => 'English',
                'short' => 'en',
                'page_up' => 2,
            ],
        ];

        foreach ($languages as $language) {
            Languages::create($language);
        }
    }
}
