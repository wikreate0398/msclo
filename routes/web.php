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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('preview-notification', function () {
    $user = \App\Models\User::whereId(1)->first();
    return (new \App\Notifications\SendBill('123123', '21312', 'asd'))->toMail($user);
});

Route::get('page-404', function () {
    return response()->view('errors.404', [], 404);
})->name('404');

$adminPath = config('admin.path');

Route::get($adminPath . '/login', 'Admin\LoginController@showLoginForm', ['guard' => 'admin'])->name('admin_login');
Route::post($adminPath . '/login', 'Admin\LoginController@login', ['guard' => 'admin'])->name('admin_run_login');

Route::group(['prefix' => $adminPath, 'namespace' => 'Admin', 'middleware' => ['admin', 'web']], function () {
    Route::get('/', function () {
        return redirect()->route('admin_menu');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', 'MenuController@show')->name('admin_menu');
        Route::get('{id}/edit', 'MenuController@showeditForm');
        Route::post('create', 'MenuController@create');
        Route::post('{id}/update', 'MenuController@update');
    });

    Route::group(['prefix' => 'constants'], function () {
        Route::get('/', 'ConstantsController@show')->name('admin_constants');
        Route::post('create', 'ConstantsController@create');
        Route::post('createConstant', 'ConstantsController@createConstant');
    });

    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'LanuagesController@show')->name('admin_languages');
        Route::get('{id}/edit', 'LanuagesController@showeditForm');
        Route::get('add', 'LanuagesController@showAddForm');
        Route::post('create', 'LanuagesController@create');
        Route::post('{id}/update', 'LanuagesController@update');
    });

    Route::group(['prefix' => 'slider'], function () {
        Route::get('/', 'SliderController@show')->name('admin_slider');
        Route::get('{id}/edit', 'SliderController@showeditForm');
        Route::post('create', 'SliderController@create');
        Route::post('{id}/update', 'SliderController@update');
    });

    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', 'BrandsController@show')->name('admin_brands');
        Route::get('{id}/edit', 'BrandsController@showeditForm');
        Route::post('create', 'BrandsController@create');
        Route::post('{id}/update', 'BrandsController@update');
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannersController@show')->name('admin_banners');
        Route::get('{id}/edit', 'BannersController@showeditForm');
        Route::post('create', 'BannersController@create');
        Route::post('{id}/update', 'BannersController@update');
    });

    Route::group(['prefix' => 'advantages'], function () {
        Route::get('/', 'AdvantagesController@show')->name('admin_advantages');
        Route::get('{id}/edit', 'AdvantagesController@showeditForm');
        Route::post('create', 'AdvantagesController@create');
        Route::post('{id}/update', 'AdvantagesController@update');
    });

    Route::group(['prefix' => 'profile-menu'], function () {
        Route::get('/', 'ProfileMenuController@show')->name('admin_profile_menu');
        Route::get('{id}/edit', 'ProfileMenuController@showeditForm');
        Route::post('create', 'ProfileMenuController@create');
        Route::post('{id}/update', 'ProfileMenuController@update');
        Route::post('save-access', 'ProfileMenuController@saveAccess');
    });

    Route::group(['prefix' => 'email-templates'], function () {
        Route::get('/', 'EmailTemplatesController@show')->name('admin_email_templates');
        Route::get('{id}/edit', 'EmailTemplatesController@showeditForm');
        Route::post('{id}/update', 'EmailTemplatesController@update');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingsController@show')->name('admin_settings');
        Route::post('save', 'SettingsController@save');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UsersController@show')->name('admin_users');
        Route::get('{id}/edit', 'UsersController@showeditForm');
        Route::get('add', 'UsersController@showAddForm');
        Route::post('create', 'UsersController@create');
        Route::post('{id}/update', 'UsersController@update');
        Route::post('{id}/send-letter', 'ClientsController@sendLetter');
        Route::post('{id}/waiter-bill', 'ClientsController@waiterBill');
        Route::get('{id}/autologin', 'UsersController@autologin');
    });

    Route::group(['prefix' => 'oficiant-profile'], function () {
        Route::group(['prefix' => 'backgrounds'], function () {
            Route::get('/', 'BackgroundsController@show')->name('admin_backgrounds');
            Route::get('{id}/edit', 'BackgroundsController@showeditForm');
            Route::post('create', 'BackgroundsController@create');
            Route::post('{id}/update', 'BackgroundsController@update');
        });

        Route::group(['prefix' => 'contact-us'], function () {
            Route::get('/', 'ContactUsController@show')->name('admin_contact_us');
            Route::get('{id}/edit', 'ContactUsController@showeditForm');
            Route::post('create', 'ContactUsController@create');
            Route::post('{id}/update', 'ContactUsController@update');
        });
    });

    Route::group(['prefix' => 'catalog', 'namespace' => 'Catalog'], function () {
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoriesController@show')->name('admin_categories');
            Route::get('{id}/edit', 'CategoriesController@showeditForm');
            Route::post('create', 'CategoriesController@create');
            Route::post('{id}/update', 'CategoriesController@update');
        });

        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagsController@show')->name('admin_tags');
            Route::get('{id}/edit', 'TagsController@showeditForm');
            Route::post('create', 'TagsController@create');
            Route::post('{id}/update', 'TagsController@update');
        });

        Route::group(['prefix' => 'chars'], function () {
            Route::get('/', 'CharsController@show')->name('admin_chars');
            Route::get('{id}/edit', 'CharsController@showeditForm');
            Route::post('create', 'CharsController@create');
            Route::post('{id}/update', 'CharsController@update');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductsController@show')->name('admin_products');
            Route::get('{id}/edit', 'ProductsController@showeditForm');
            Route::post('create', 'ProductsController@create');
            Route::post('{id}/update', 'ProductsController@update');
        });
    });

    Route::group(['prefix' => 'providers-services'], function () {
        Route::get('/', 'ProvidersServicesController@show')->name('admin_providers_services');
        Route::get('{id}/edit', 'ProvidersServicesController@showeditForm');
        Route::post('create', 'ProvidersServicesController@create');
        Route::post('{id}/update', 'ProvidersServicesController@update');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@showForm')->name('profile');
        Route::get('{id}/edit-user', 'ProfileController@editAdminUser');
        Route::post('{id}/update-admin-user', 'ProfileController@updateAdminUser');
        Route::post('edit', 'ProfileController@edit');
        Route::post('addNewUser', 'ProfileController@addNewUser');
        Route::get('/logs-report/{id_user}', 'ProfileController@showLogsReport');
    });

    Route::group(['prefix' => 'ajax'], function () {
        Route::post('depth-sort', 'AjaxController@depthSort')->name('depth_sort');
        Route::post('viewElement', 'AjaxController@viewElement')->name('viewElement');
        Route::post('deleteElement', 'AjaxController@deleteElement')->name('deleteElement');
        Route::post('deleteImg', 'AjaxController@deleteImg')->name('deleteImg');
        Route::post('sortElement', 'AjaxController@sortElement')->name('sortElement');
        Route::post('deleteImageByField', 'AjaxController@deleteImageByField');
    });

    Route::get('logout', 'LoginController@logout')->name('admin_logout');
});



Route::get('/', 'HomeController@index')->middleware(['lang', 'web', 'const'])->name('home');
Route::post('/chart-data/{value}', 'Profile\DashboardController@getChartDays')->name('chart_data');

Route::group(['prefix' => '{lang}', 'middleware' => ['lang', 'web', 'const']], function () {
    Route::get('/', 'HomeController@index');

    Route::post('callback', 'HomeController@callback')->name('callback');

    Route::group(['prefix' => 'favorites'], function () {
        Route::post('add', 'FavoritesController@add')->name('add_fav');
        Route::get('list', 'FavoritesController@list')->name('fav_list');
    });

    Route::group(['prefix' => 'compare'], function () {
        Route::post('add', 'CompareController@add')->name('add_compare');
        Route::get('list', 'CompareController@list')->name('compare_list');
    });

    Route::group(['prefix' => 'catalog'], function () {
        Route::get('/{url}', 'CatalogController@list')->name('view_catalog');
        Route::get('product/{url}', 'CatalogController@viewProduct')->name('view_product');
    });

    Route::group(['prefix' => 'suppliers'], function () {
        Route::get('/', 'ProviderController@list')->name('view_providers');
        Route::get('view/{id}', 'ProviderController@viewProvider')->name('view_provider');
        Route::get('download-file/{id_file}', 'ProviderController@downloadFile')->name('provider_dwn_file');

        Route::post('leave-message/{id}', 'ProviderController@leaveMessage')->name('provider_send_contact');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('view', 'CartController@view')->name('view_cart');

        Route::get('load-modal', 'CartController@loadModal')->name('load_cart_modal');
        Route::post('add', 'CartController@add')->name('add_to_cart');
        Route::post('change-price', 'CartController@changePriceByQty')->name('change_price');
        Route::post('remove-cart', 'CartController@removeCart')->name('remove_cart');
        Route::post('change-qty', 'CartController@changeQty')->name('change_qty');

        Route::group(['middleware' => ['web_auth', 'cart']], function () {
            Route::get('checkout', 'CartController@showCheckout')->name('view_checkout');
            Route::post('checkout', 'CartController@checkout')->name('checkout');
        });
        Route::get('success', 'CartController@success')->name('order_added');
    });
    
    Route::group(['middleware' => 'guest'], function () {
        Route::post('register', 'Auth\RegisterController@register')->name('register_user');
        Route::get('registration-confirm/{confirmation_hash}', 'Auth\RegisterController@confirmation')->name('registration_confirm');

        Route::post('login', 'Auth\LoginController@login')->name('login');
        Route::post('reset-password', 'Auth\ForgotPasswordController@sendResetPassword')->name('send_reset_pass');
    });

    Route::group(['prefix' => 'profile', 'namespace' => 'Profile', 'middleware' => 'web_auth'], function () {
        Route::group(['prefix' => 'account'], function () {
            Route::get('/', 'AccountController@index')->name('account');
            Route::post('edit-userdata', 'AccountController@edit')->name('edit_userdata');
            Route::post('change-password', 'AccountController@changePassword')->name('change_password');
            Route::post('save-avatar', 'AccountController@saveAvatar')->name('save_avatar');
        });

        Route::group(['prefix' => 'purchases'], function () {
            Route::get('/', 'PurchasesController@index')->name('purchases');
        });

        Route::group(['prefix' => 'statistics'], function () {
            Route::get('/', 'DashboardController@index')->name('statistics');
            Route::post('callback', 'DashboardController@callback')->name('statistics.callback');
        });

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrdersController@index')->name('orders');
        });

        Route::group(['prefix' => 'files'], function () {
            Route::get('/', 'FilesController@index')->name('files');
            Route::post('save', 'FilesController@saveFiles')->name('save_files');
            Route::post('delete', 'FilesController@delete')->name('delete_file');
        });

        Route::group(['prefix' => 'services'], function () {
            Route::get('/', 'ServicesController@index')->name('services');
            Route::post('save', 'ServicesController@save')->name('save_services');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductsController@index')->name('view_profile_product');
            Route::get('{id}/edit', 'ProductsController@showEditForm')->name('view_edit_product');

            Route::get('add-form', 'ProductsController@showAddForm')->name('profile_add_product');
            Route::post('create', 'ProductsController@create')->name('create_product');
            Route::post('{id}\update', 'ProductsController@update')->name('update_product');
            Route::get('delete/{id}', 'ProductsController@delete')->name('delete_product');
            Route::post('delete-image', 'ProductsController@deleteImage')->name('delete_product_image');
        });

        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', 'ContactsController@index')->name('provider_contacts');
            Route::post('save', 'ContactsController@save')->name('save_provider_contacts');
        });
    });


    /*
     * Routes for authorized users
     */
    Route::group(['middleware' => ['web_auth']], function () {
        Route::get('logout', function () {
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
