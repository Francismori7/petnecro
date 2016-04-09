<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['api']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    /* Dashboard - user info */
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);
        Route::get('edit/profile', ['as' => 'edit.profile', 'uses' => 'DashboardController@editProfile']);
        Route::get('edit/account', ['as' => 'edit.account', 'uses' => 'DashboardController@editAccount']);
        Route::post('/profile', ['as' => 'store.profile', 'uses' => 'DashboardController@storeProfile']);
        Route::patch('/profile', ['as' => 'update.profile', 'uses' => 'DashboardController@updateProfile']);
        Route::patch('/account', ['as' => 'update.account', 'uses' => 'DashboardController@updateAccount']);

        Route::get('subscription', ['as' => 'billing.subscription', 'uses' => 'SubscriptionController@index']);
        Route::patch('subscription',
            ['as' => 'billing.subscription.update', 'uses' => 'SubscriptionController@update']);
        Route::get('invoices', ['as' => 'billing.invoices', 'uses' => 'SubscriptionController@invoices']);
    });
});
