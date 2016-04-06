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
        Route::get('edit', ['as' => 'edit', 'uses' => 'DashboardController@edit']);
        Route::get('edit/account', ['as' => 'edit.account', 'uses' => 'DashboardController@editAccount']);
        Route::post('/', ['as' => 'store', 'uses' => 'DashboardController@store']);
        Route::patch('/', ['as' => 'update', 'uses' => 'DashboardController@update']);
        Route::patch('/account', ['as' => 'update.account', 'uses' => 'DashboardController@updateAccount']);

        Route::get('subscription', ['as' => 'billing.subscription', 'uses' => 'SubscriptionController@index']);
        Route::patch('subscription',
            ['as' => 'billing.subscription.update', 'uses' => 'SubscriptionController@update']);
        Route::get('invoices', ['as' => 'billing.invoices', 'uses' => 'SubscriptionController@invoices']);
    });
});
