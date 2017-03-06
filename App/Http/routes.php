<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    Route::get('/', [
        'uses' => 'AudioMessageController@getIndex',
        'as' => 'store.index'
    ]);

    Route::get('admin-signin', [
        'uses' => 'UserController@getSignIn',
        'as'   => 'admin.signin'
    ]);

    Route::post('admin-signin', [
        'uses' => 'UserController@postSignIn',
        'as' => 'admin.signin'
    ]);

    Route::get('dashboard', [
        'uses' => 'UserController@getDashboard',
        'as' => 'admin.dashboard'
    ]);

    Route::post('dashboard', [
        'uses' => 'AudioMessageController@uploadAudioMessage',
        'as' => 'uploadAudioMessage'
    ]);

    Route::delete('dashboard/{audio_message}/delete', [
        'uses' => 'AudioMessageController@deleteAudioMessage',
        'as' => 'deleteAudio'
    ]);

    Route::get('categories', [
        'uses' => 'AudioMessageController@getCategories',
        'as' => 'admin.categories'
    ]);

    Route::post('categories', [
        'uses' => 'AudioMessageController@postCategories',
        'as' => 'admin.categories'
    ]);

    Route::get('categories/{category}/edit', [
        'uses' => 'AudioMessageController@getEditCategory',
        'as' => 'editCategory'
    ]);

    Route::delete('categories/{category}/delete', [
        'uses' => 'AudioMessageController@deleteCategory',
        'as' => 'deleteCategory'
    ]);

    Route::get('signout', [
        'uses' => 'UserController@getSignOut',
        'as' => 'signout'
    ]);