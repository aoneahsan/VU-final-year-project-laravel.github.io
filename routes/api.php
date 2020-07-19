<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("okok", function () {
    return "working";
});

Route::post('login', 'Api\Auth\ApiAuthController@loginApi');
Route::post('register', 'Api\Auth\ApiAuthController@registerApi');

Route::group([
    'middleware' => 'auth:sanctum',
    'namespace' => 'Api'
], function () {

    // Check Login Status To AutoLogout
    Route::get('check-login-status', 'Auth\ApiAuthController@checkLoginStatus');

    // Logout API
    Route::post('logout', 'Auth\ApiAuthController@logoutApi');

    // User Profile APIs
    Route::get('user/profile', 'User\ApiUserController@getUserProfileData');
    Route::post('user/profile/update', 'User\ApiUserController@updateUserProfile');
    Route::post('user/profile-img/update', 'User\ApiUserController@updateUserProfileImage');
    Route::delete('user', 'User\ApiUserController@deleteUserAccount');

    Route::get('user/bookings', 'User\ApiUserController@getUserProfileData');

    Route::post('search-halls', 'Hall\ApiHallController@searchHalls');
});

Route::group([
    'middleware' => ['auth:sanctum'],
    'namespace' => 'Api'
], function () {
    // Get Customers
    Route::get('admin/get-customers', 'Admin\ApiAdminController@getCustomers');

    // Get hall_managers
    Route::get('admin/get-hall_managers', 'Admin\ApiAdminController@getHallManagers');

    // Get Halls
    Route::get('admin/get-halls', 'Admin\ApiAdminController@getAllHalls');

    // Get Bookings
    Route::get('admin/get-bookings', 'Admin\ApiAdminController@getBookings');
});