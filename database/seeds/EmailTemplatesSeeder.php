<?php

use App\Models\EmailTemplates;
use Illuminate\Database\Seeder;

class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emailTemplates = [
            [
                'name' => 'Подтверждение регистрации',
                'var' => 'confirm_registration',
                'const' => 'CONFIRMATION_LINK,USERNAME',
                'theme_ru' => '☆Massclo: Новое сообщение',
                'message_ru' => '<p>Здравствуйте, {USERNAME}!<br>Добро пожаловать на наш портал.<br>Подтвердите свой почту перейдя по <a href="{CONFIRMATION_LINK}">ссылке</a></p>',
                'message_en' => 'Hello {USERNAME}!<br />
                Welcome to our portal. Thank you for using our application!<br />
                Please,&nbsp;confirm your account by clicking on the <a href="{CONFIRMATION_LINK}">link</a>'
            ],
            [
                'name' => 'Сбросить новый пароль',
                'var' => 'reset_password',
                'const' => 'USERNAME,NEW_PASSWORD',
                'theme_ru' => '☆Massclo: Новое сообщение',
                'message_ru' => 'Здравствуйте {USERNAME}!<br />
                Ваш новый пароль: {NEW_PASSWORD}',
                'message_en' => '<h3>Hello {USERNAME}!</h3>
                Your new password: {NEW_PASSWORD}'
            ],
            [
                'name' => 'Сообщение клиента поставщику',
                'var' => 'provider_contact',
                'const' => 'USERNAME,PHONE,EMAIL,MESSAGE',
                'theme_ru' => '☆Massclo: Новое сообщение',
                'message_ru' => '<p>Пользователь по имени {USERNAME}</p><p>Оставил свои контактные данные</p><p><strong>Email</strong>: {EMAIL}</p><p><strong>Телефон</strong>: {PHONE}</p><p><strong>Сообщение</strong>: {MESSAGE}</p>',
                'message_en' => '<h3>Hello {USERNAME}!</h3>
                Your new password: {NEW_PASSWORD}'
            ],
        ];

        foreach ($emailTemplates as $emailTemplates) {
            EmailTemplates::create($emailTemplates);
        }
    }
}
