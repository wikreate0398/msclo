<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ConstantCategorySeeder::class);
        $this->call(ConstantSeeder::class);
        $this->call(ConstantValueSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(EmailTemplatesSeeder::class);
        $this->call(ProfileMenuSeeder::class);
        $this->call(ProfileMenuGuardSeeder::class);
    }
}
