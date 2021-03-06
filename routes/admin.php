<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Admin" middleware group. Enjoy building your Admin!
|
*/
Route::get('app/lang', 'HomeController@lang');


/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
| Here is where admin auth routes exists for login and log out
*/
Route::group([
    'namespace'  => 'Auth',
], function() {
    Route::get('login', ['uses' => 'LoginController@showLoginForm','as'=>'admin.login']);
    Route::post('login', ['uses' => 'LoginController@login']);
    Route::group([
        'middleware' => 'auth.admin',
    ], function() {
        Route::post('logout', ['uses' => 'LoginController@logout','as'=>'admin.logout']);
    });
});
/*
|--------------------------------------------------------------------------
| Admin After login in
|--------------------------------------------------------------------------
| Here is where admin panel routes exists after login in
*/
Route::group([
    'middleware'  => 'auth.admin',
], function() {
    Route::get('/', 'HomeController@index');
    Route::get('delete/media', 'HomeController@delete_media');
    Route::post('notification/send', 'HomeController@general_notification');

    /*
    |--------------------------------------------------------------------------
    | Admin > App Management
    |--------------------------------------------------------------------------
    | Here is where App Management routes
    */

    Route::group([
        'prefix'=>'app_managements',
        'namespace'=>'AppManagement',
    ],function () {
        Route::group([
            'prefix'=>'employees'
        ],function () {
            Route::get('/','AdminController@index');
            Route::get('/create','AdminController@create');
            Route::post('/','AdminController@store');
            Route::get('/{admin}','AdminController@show');
            Route::get('/{admin}/edit','AdminController@edit');
            Route::put('/{admin}','AdminController@update');
            Route::delete('/{admin}','AdminController@destroy');
            Route::patch('/update/password',  'AdminController@updatePassword');
            Route::get('/option/export','AdminController@export');
            Route::get('/{id}/activation','AdminController@activation');
        });
        Route::group([
            'prefix'=>'roles'
        ],function () {
            Route::get('/','RoleController@index');
            Route::get('/create','RoleController@create');
            Route::post('/','RoleController@store');
            Route::get('/{role}','RoleController@show');
            Route::get('/{role}/edit','RoleController@edit');
            Route::put('/{role}','RoleController@update');
            Route::delete('/{role}','RoleController@destroy');
            Route::get('/option/export','RoleController@export');
        });
        Route::group([
            'prefix'=>'permissions'
        ],function () {
            Route::get('/','PermissionController@index');
            Route::get('/create','PermissionController@create');
            Route::post('/','PermissionController@store');
            Route::get('/{permission}','PermissionController@show');
            Route::get('/{permission}/edit','PermissionController@edit');
            Route::put('/{permission}','PermissionController@update');
            Route::delete('/{permission}','PermissionController@destroy');
            Route::get('/option/export','PermissionController@export');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Admin > App Data
    |--------------------------------------------------------------------------
    | Here is where App Data routes
    */
    Route::group([
        'prefix'=>'app_data',
        'namespace'=>'AppData',
    ],function () {
        Route::group([
            'prefix'=>'settings'
        ],function () {
            Route::get('/','SettingController@index');
            Route::get('/{setting}/edit','SettingController@edit');
            Route::put('/{setting}','SettingController@update');
        });

        Route::group([
            'prefix'=>'faqs'
        ],function () {
            Route::get('/','FaqController@index');
            Route::get('/create','FaqController@create');
            Route::post('/','FaqController@store');
            Route::get('/{faq}','FaqController@show');
            Route::get('/{faq}/edit','FaqController@edit');
            Route::put('/{faq}','FaqController@update');
            Route::delete('/{faq}','FaqController@destroy');
            Route::get('/option/export','FaqController@export');
            Route::get('/{id}/activation','FaqController@activation');
        });
        Route::group([
            'prefix'=>'categories'
        ],function () {
            Route::get('/','CategoryController@index');
            Route::get('/create','CategoryController@create');
            Route::post('/','CategoryController@store');
            Route::get('/{category}','CategoryController@show');
            Route::get('/{category}/edit','CategoryController@edit');
            Route::put('/{category}','CategoryController@update');
            Route::delete('/{category}','CategoryController@destroy');
            Route::get('/option/export','CategoryController@export');
        });
        Route::group([
            'prefix'=>'subscriptions'
        ],function () {
            Route::get('/','SubscriptionController@index');
            Route::get('/create','SubscriptionController@create');
            Route::post('/','SubscriptionController@store');
            Route::get('/{subscription}','SubscriptionController@show');
            Route::get('/{subscription}/edit','SubscriptionController@edit');
            Route::put('/{subscription}','SubscriptionController@update');
            Route::delete('/{subscription}','SubscriptionController@destroy');
            Route::get('/option/export','SubscriptionController@export');
        });
        Route::group([
            'prefix'=>'sub_categories'
        ],function () {
            Route::get('/','SubCategoryController@index');
            Route::get('/create','SubCategoryController@create');
            Route::post('/','SubCategoryController@store');
            Route::get('/{sub_category}','SubCategoryController@show');
            Route::get('/{sub_category}/edit','SubCategoryController@edit');
            Route::put('/{sub_category}','SubCategoryController@update');
            Route::delete('/{sub_category}','SubCategoryController@destroy');
            Route::get('/option/export','SubCategoryController@export');
        });
        Route::group([
            'prefix'=>'countries'
        ],function () {
            Route::get('/','CountryController@index');
            Route::get('/create','CountryController@create');
            Route::post('/','CountryController@store');
            Route::get('/{country}','CountryController@show');
            Route::get('/{country}/edit','CountryController@edit');
            Route::put('/{country}','CountryController@update');
            Route::delete('/{country}','CountryController@destroy');
            Route::get('/option/export','CountryController@export');
        });
        Route::group([
            'prefix'=>'cities'
        ],function () {
            Route::get('/','CityController@index');
            Route::get('/create','CityController@create');
            Route::post('/','CityController@store');
            Route::get('/{city}','CityController@show');
            Route::get('/{city}/edit','CityController@edit');
            Route::put('/{city}','CityController@update');
            Route::delete('/{city}','CityController@destroy');
            Route::get('/option/export','CityController@export');
        });
        Route::group([
            'prefix'=>'issues'
        ],function () {
            Route::get('/','IssueController@index');
            Route::get('/create','IssueController@create');
            Route::post('/','IssueController@store');
            Route::get('/{issue}','IssueController@show');
            Route::get('/{issue}/edit','IssueController@edit');
            Route::put('/{issue}','IssueController@update');
            Route::delete('/{issue}','IssueController@destroy');
            Route::get('/option/export','IssueController@export');
        });
        Route::group([
            'prefix'=>'issues_types'
        ],function () {
            Route::get('/','IssueTypeController@index');
            Route::get('/create','IssueTypeController@create');
            Route::post('/','IssueTypeController@store');
            Route::get('/{issue_type}','IssueTypeController@show');
            Route::get('/{issue_type}/edit','IssueTypeController@edit');
            Route::put('/{issue_type}','IssueTypeController@update');
            Route::delete('/{issue_type}','IssueTypeController@destroy');
            Route::get('/option/export','IssueTypeController@export');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Admin > App
    |--------------------------------------------------------------------------
    | Here is where App Content routes
    */
    Route::group([
        'prefix'=>'app_content',
        'namespace'=>'AppContent',
    ],function () {
        Route::group([
            'prefix'=>'advertisements'
        ],function () {
            Route::get('/','AdvertisementController@index');
            Route::get('/create','AdvertisementController@create');
            Route::post('/','AdvertisementController@store');
            Route::get('/{advertisement}','AdvertisementController@show');
            Route::get('/{advertisement}/edit','AdvertisementController@edit');
            Route::put('/{advertisement}','AdvertisementController@update');
            Route::delete('/{advertisement}','AdvertisementController@destroy');
            Route::get('/option/export','AdvertisementController@export');
        });
        Route::group([
            'prefix'=>'orders'
        ],function () {
            Route::get('/','OrderController@index');
            Route::get('/create','OrderController@create');
            Route::post('/','OrderController@store');
            Route::get('/{order}','OrderController@show');
            Route::get('/{order}/edit','OrderController@edit');
            Route::put('/{order}','OrderController@update');
            Route::delete('/{order}','OrderController@destroy');
            Route::get('/option/export','OrderController@export');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Admin > App Users
    |--------------------------------------------------------------------------
    | Here is where App Users routes
    */

    Route::group([
        'prefix'=>'user_managements',
        'namespace'=>'UserManagement',
    ],function () {
        Route::group([
            'prefix'=>'customers'
        ],function () {
            Route::get('/','CustomerController@index');
            Route::get('/create','CustomerController@create');
            Route::post('/','CustomerController@store');
            Route::get('/{customer}','CustomerController@show');
            Route::get('/{customer}/edit','CustomerController@edit');
            Route::put('/{customer}','CustomerController@update');
            Route::patch('/update/password',  'CustomerController@updatePassword');
            Route::get('/option/export','CustomerController@export');
            Route::get('/{id}/activation','CustomerController@activation');
            Route::get('/{customer}/active_mobile_email','CustomerController@active_mobile_email');
        });
        Route::group([
            'prefix'=>'technicals'
        ],function () {
            Route::get('/','TechnicalController@index');
            Route::get('/create','TechnicalController@create');
            Route::post('/','TechnicalController@store');
            Route::get('/{technical}','TechnicalController@show');
            Route::get('/{technical}/edit','TechnicalController@edit');
            Route::put('/{technical}','TechnicalController@update');
            Route::patch('/update/password',  'TechnicalController@updatePassword');
            Route::get('/option/export','TechnicalController@export');
            Route::get('/{technical}/activation','TechnicalController@activation');
            Route::get('/{technical}/active_mobile_email','TechnicalController@active_mobile_email');
            Route::get('/{technical}/edit_times','TechnicalController@edit_times');
            Route::post('/{technical}/edit_times','TechnicalController@post_edit_times');
        });
        Route::group([
            'prefix'=>'users_subscriptions'
        ],function () {
            Route::get('/','UserSubscriptionController@index');
            Route::get('/{user_subscription}/approve','UserSubscriptionController@approve');
            Route::get('/{user_subscription}/reject','UserSubscriptionController@reject');
        });
        Route::group([
            'prefix'=>'tickets'
        ],function () {
            Route::get('/','TicketController@index');
            Route::get('/create','TicketController@create');
            Route::post('/','TicketController@store');
            Route::get('/{ticket}','TicketController@show');
            Route::post('/{ticket}/response','TicketController@response');
            Route::get('/{ticket}/close','TicketController@close');

        });
    });
});
