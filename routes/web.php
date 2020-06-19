<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('preview-notification', function () {
    $user = \App\Models\User::whereId(1)->first();
    return (new \App\Notifications\SendBill('123123', '21312', 'asd'))->toMail($user);
});

Route::get('page-404', function(){
	return response()->view('errors.404', [], 404);
})->name('404');

$adminPath = config('admin.path');

Route::get($adminPath . '/login', 'Admin\LoginController@showLoginForm', ['guard' => 'admin'])->name('admin_login');
Route::post($adminPath . '/login', 'Admin\LoginController@login', ['guard' => 'admin'])->name('admin_run_login');

Route::group(['prefix' => $adminPath, 'namespace' => 'Admin', 'middleware' => ['admin', 'web']], function() {
	Route::get('/', function(){
		return redirect()->route('admin_menu');
	});

	Route::group(['prefix' => 'menu'], function() {
		Route::get('/', 'MenuController@show')->name('admin_menu');
		Route::get('{id}/edit', 'MenuController@showeditForm');
		Route::post('create', 'MenuController@create');
		Route::post('{id}/update', 'MenuController@update');
	});

    Route::group(['prefix' => 'constants'], function() {
        Route::get('/', 'ConstantsController@show')->name('admin_constants');
        Route::post('create', 'ConstantsController@create');
        Route::post('createConstant', 'ConstantsController@createConstant');
    });

	Route::group(['prefix' => 'languages'], function() {
		Route::get('/', 'LanuagesController@show')->name('admin_languages');
		Route::get('{id}/edit', 'LanuagesController@showeditForm');
		Route::get('add', 'LanuagesController@showAddForm');
		Route::post('create', 'LanuagesController@create');
		Route::post('{id}/update', 'LanuagesController@update');
	});

	Route::group(['prefix' => 'advantages'], function() {
		Route::get('/', 'AdvantagesController@show')->name('admin_advantages');
		Route::get('{id}/edit', 'AdvantagesController@showeditForm');
		Route::post('create', 'AdvantagesController@create');
		Route::post('{id}/update', 'AdvantagesController@update');
	});

    Route::group(['prefix' => 'profile-menu'], function() {
        Route::get('/', 'ProfileMenuController@show')->name('admin_profile_menu');
        Route::get('{id}/edit', 'ProfileMenuController@showeditForm');
        Route::post('create', 'ProfileMenuController@create');
        Route::post('{id}/update', 'ProfileMenuController@update');
        Route::post('save-access', 'ProfileMenuController@saveAccess');
    });

    Route::group(['prefix' => 'email-templates'], function() {
        Route::get('/', 'EmailTemplatesController@show')->name('admin_email_templates');
        Route::get('{id}/edit', 'EmailTemplatesController@showeditForm');
        Route::post('{id}/update', 'EmailTemplatesController@update');
    });

    Route::group(['prefix' => 'settings'], function() {
        Route::get('/', 'SettingsController@show')->name('admin_settings');
        Route::post('save', 'SettingsController@save');
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UsersController@show')->name('admin_users');
        Route::get('{id}/edit', 'UsersController@showeditForm');
        Route::get('add', 'UsersController@showAddForm');
        Route::post('create', 'UsersController@create');
        Route::post('{id}/update', 'UsersController@update');
        Route::post('{id}/send-letter', 'ClientsController@sendLetter');
        Route::post('{id}/waiter-bill', 'ClientsController@waiterBill');
        Route::get('{id}/autologin', 'UsersController@autologin');
    });

    Route::group(['prefix' => 'oficiant-profile'], function() {
        Route::group(['prefix' => 'backgrounds'], function() {
            Route::get('/', 'BackgroundsController@show')->name('admin_backgrounds');
            Route::get('{id}/edit', 'BackgroundsController@showeditForm');
            Route::post('create', 'BackgroundsController@create');
            Route::post('{id}/update', 'BackgroundsController@update');
        });

        Route::group(['prefix' => 'contact-us'], function() {
            Route::get('/', 'ContactUsController@show')->name('admin_contact_us');
            Route::get('{id}/edit', 'ContactUsController@showeditForm');
            Route::post('create', 'ContactUsController@create');
            Route::post('{id}/update', 'ContactUsController@update');
        });
    });

    Route::group(['prefix' => 'catalog', 'namespace' => 'Catalog'], function() {
        Route::group(['prefix' => 'categories'], function() {
            Route::get('/', 'CategoriesController@show')->name('admin_categories');
            Route::get('{id}/edit', 'CategoriesController@showeditForm');
            Route::post('create', 'CategoriesController@create');
            Route::post('{id}/update', 'CategoriesController@update');
        });

        Route::group(['prefix' => 'chars'], function() {
            Route::get('/', 'CharsController@show')->name('admin_chars');
            Route::get('{id}/edit', 'CharsController@showeditForm');
            Route::post('create', 'CharsController@create');
            Route::post('{id}/update', 'CharsController@update');
        });

        Route::group(['prefix' => 'products'], function() {
            Route::get('/', 'ProductsController@show')->name('admin_products');
            Route::get('{id}/edit', 'ProductsController@showeditForm');
            Route::post('create', 'ProductsController@create');
            Route::post('{id}/update', 'ProductsController@update');
        });
    });

	Route::group(['prefix' => 'profile'], function() {
        Route::get('/', 'ProfileController@showForm')->name('profile');
        Route::get('{id}/edit-user', 'ProfileController@editAdminUser');
        Route::post('{id}/update-admin-user', 'ProfileController@updateAdminUser');
        Route::post('edit', 'ProfileController@edit');
        Route::post('addNewUser', 'ProfileController@addNewUser');
        Route::get('/logs-report/{id_user}', 'ProfileController@showLogsReport');
    });

	Route::group(['prefix' => 'ajax'], function() {
		Route::post('depth-sort', 'AjaxController@depthSort')->name('depth_sort');
		Route::post('viewElement', 'AjaxController@viewElement')->name('viewElement');
		Route::post('deleteElement', 'AjaxController@deleteElement')->name('deleteElement');
		Route::post('deleteImg', 'AjaxController@deleteImg')->name('deleteImg');
        Route::post('sortElement', 'AjaxController@sortElement')->name('sortElement');
	});

	Route::get('logout', 'LoginController@logout')->name('admin_logout');
});

Route::get('/', 'HomeController@index')->middleware(['lang', 'web'])->name('home');

Route::group(['prefix' => '{lang}', 'middleware' => ['lang', 'web']], function() {

    Route::get('/', 'HomeController@index');
    Route::post('questions', 'HomeController@questions')->name('questions');
    Route::post('set-code', 'Pay\PaymentController@setСode')->name('set_code_home');
    Route::post('give-thanks', 'HomeController@giveThanks')->name('give_thanks');
    
    Route::group(['middlewars' => 'guest'], function(){
        Route::get('registration', 'Auth\RegisterController@showForm')->name('registration');
        Route::post('register', 'Auth\RegisterController@register')->name('register');
        Route::get('registration-confirm/{confirmation_hash}', 'Auth\RegisterController@confirmation')->name('registration_confirm');

        Route::get('finish-registration/{hash}', 'Auth\RegisterController@finishRegistrationForm')->name('finish_registration');
        Route::post('update-registration', 'Auth\RegisterController@finishRegistration')->name('update_registration');

        Route::post('login', 'Auth\LoginController@login')->name('login');
        Route::get('login', 'Auth\LoginController@showLogin')->name('show_login');
        Route::post('reset-password', 'Auth\ForgotPasswordController@sendResetPassword')->name('send_reset_pass');

        Route::group(['prefix' => 'profile', 'namespace' => 'Profile', 'middleware' => 'web_auth'], function() {

            Route::group(['prefix' => 'account'], function() {
                Route::get('/', 'AccountController@index')->name('account');
                Route::post('edit-userdata', 'AccountController@edit')->name('edit_userdata');
                Route::post('change-password', 'AccountController@changePassword')->name('change_password');
                Route::post('save-avatar', 'AccountController@saveAvatar')->name('save_avatar');
                Route::post('upload-verification-file', 'AccountController@uploadVerificationFile')->name('upload_verification_file');

                Route::post('invitation-response', 'AccountController@invitationResponse')->name('invitation_response');
            });

            Route::group(['prefix' => 'contact-us'], function() {
                Route::get('/', 'ContactController@index')->name('contact');
                Route::post('send', 'ContactController@send')->name('send_contact_us');
            });

            Route::group(['prefix' => 'my-referrals'], function() {
                Route::get('/', 'MyReferralsController@index')->name('my_referrals');
            });

            Route::group(['prefix' => 'workspace'], function() {
                Route::get('/', 'WorkspaceController@index')->name('workspace');
                Route::post('add-qr', 'WorkspaceController@addQrCode')->name('add_qr');
                Route::get('delete-qr/{id}', 'WorkspaceController@deleteQrCode')->name('delete_qr');
                Route::get('to-pdf/{id}', 'WorkspaceController@qrCodeToPdf')->name('qr_to_pdf');
            });

            Route::group(['prefix' => 'ballance'], function() {
                Route::get('/', 'BallanceController@index')->name('ballance');
                Route::post('add-credit-card', 'BallanceController@addCreditCard')->name('add_card');
                Route::post('withdraw-funds', 'BallanceController@withdrawFunds')->name('withdraw_funds');
                Route::get('delete-credit-card/{id}', 'BallanceController@deleteCreditCard')->name('delete_card');
            });

            Route::group(['prefix' => 'my-oficiants'], function() {
                Route::get('/', 'OficiantsController@index')->name('my_oficiants');
                Route::post('add-oficiant', 'OficiantsController@addNewOficiant')->name('add_oficiant');
                Route::post('inviteOficiant', 'OficiantsController@inviteOficiant')->name('invite_oficiant');
                Route::post('request-money', 'OficiantsController@requestMoney')->name('request_money');
            });

            Route::get('agent-enrollment', 'Partner\PartnerEnrollmentController@index')->name('partner_enrollment');
            Route::get('enrollment', 'EnrollmentController@index')->name('enrollment');
        });
    });

    /*
     * Routes for authorized users
     */
    Route::group(['middleware' => ['web_auth']], function(){
        Route::get('logout', function(){
            Auth::guard('web')->logout();
            return  redirect('/');
        })->name('logout');
    });

    /*
     * If not exist route
     */
    Route::get('{any}', 'HomeController@page');
});



//Auth::routes();

