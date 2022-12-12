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

    // Dashboard reports
    Route::get('incomes-expenses-report', [\App\Http\Controllers\Api\V1\Admin\DashboardController::class, 'getBasicReportData']);
    Route::get('bar-chart-report', [\App\Http\Controllers\Api\V1\Admin\DashboardController::class, 'getBarChartReportData']);

    // Profile photo
    Route::post('change-profile-photo', [\App\Http\Controllers\Api\V1\Admin\UsersApiController::class, 'changeProfilePhoto']);

});

Route::post('/login', \App\Http\Controllers\Api\Auth\LoginController::class);
