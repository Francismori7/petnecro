<?php

Route::post(
    'stripe/webhook',
    'Stripe\WebhookController@handleWebhook'
);

Route::group(['middleware' => ['api']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    /* Front-end API */
    Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
        Route::get('user', ['as' => 'user', 'uses' => 'Api\UserController@index']);
        Route::get('user/pets', ['as' => 'user.pets', 'uses' => 'Api\UserPetsController@index']);
    });

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
        Route::patch('subscription/quantity',
            ['as' => 'billing.subscription.updateQuantity', 'uses' => 'SubscriptionController@updateQuantity']);

        Route::post('subscription/reactivate',
            ['as' => 'billing.subscription.reactivate', 'uses' => 'SubscriptionController@reactivate']);
        Route::delete('subscription',
            ['as' => 'billing.subscription.destroy', 'uses' => 'SubscriptionController@destroy']);

        Route::get('invoices', ['as' => 'billing.invoices.index', 'uses' => 'InvoiceController@index']);
        Route::get('invoices/{invoice}', ['as' => 'billing.invoices.show', 'uses' => 'InvoiceController@show']);

        Route::get('creditcard', ['as' => 'billing.creditcard.edit', 'uses' => 'CreditCardController@edit']);
        Route::patch('creditcard', ['as' => 'billing.creditcard.update', 'uses' => 'CreditCardController@update']);

        Route::get('discount', ['as' => 'billing.discount.edit', 'uses' => 'DiscountController@edit']);
        Route::post('discount', ['as' => 'billing.discount.store', 'uses' => 'DiscountController@store']);
    });
});
