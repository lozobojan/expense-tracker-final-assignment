<?php

Route::group(['middleware' =>  ['auth:sanctum']], function(){
    Route::post('/me', \App\Http\Controllers\Api\Auth\CurrentUserController::class);
    Route::post('/logout', \App\Http\Controllers\Api\Auth\LogoutController::class);
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Category
    Route::apiResource('categories', 'CategoryApiController');
});

Route::post('/login', \App\Http\Controllers\Api\Auth\LoginController::class);
