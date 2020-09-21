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
    Route::delete('user/profile', 'User\ApiUserController@deleteUserAccount');

    Route::get('user/bookings', 'User\ApiUserController@getUserProfileData');

    Route::post('search-halls', 'Hall\ApiHallController@searchHalls');


    // Get Halls
    Route::get('hall-manager/halls', 'Hall\ApiHallController@getAllHalls');
    Route::get('hall-manager/halls/{id}', 'Hall\ApiHallController@getHallData');
    Route::post('hall-manager/halls', 'Hall\ApiHallController@createHall');
    Route::post('hall-manager/halls/{id}', 'Hall\ApiHallController@updateHallData');
    Route::delete('hall-manager/halls/{id}', 'Hall\ApiHallController@deleteHallData');
});

Route::group([
    'middleware' => ['auth:sanctum'],
    'namespace' => 'Api'
], function () {
    // Get Customers
    Route::get('admin/customers', 'Admin\ApiAdminController@getCustomers');
    Route::get('admin/customers/{id}', 'Admin\ApiAdminController@getCustomerData');
    Route::post('admin/customers/{id}', 'Admin\ApiAdminController@updateCustomerData');
    Route::delete('admin/customers/{id}', 'Admin\ApiAdminController@deleteCustomerData');

    // Get hall_managers
    Route::get('admin/hall_managers', 'Admin\ApiAdminController@getHallManagers');
    Route::get('admin/hall_managers/{id}', 'Admin\ApiAdminController@getHallManagerData');
    Route::post('admin/hall_managers/{id}', 'Admin\ApiAdminController@updateHallManagerData');
    Route::delete('admin/hall_managers/{id}', 'Admin\ApiAdminController@deteleHallManagerData');

    // Get Halls
    Route::get('admin/halls', 'Admin\ApiAdminController@getAllHalls');
    Route::get('admin/halls/{id}', 'Admin\ApiAdminController@getHallData');
    Route::post('admin/halls/{id}', 'Admin\ApiAdminController@updateHallData');
    Route::delete('admin/halls/{id}', 'Admin\ApiAdminController@deleteHallData');

    // Get Bookings
    Route::get('admin/bookings', 'Admin\ApiAdminController@getBookings');
    Route::get('admin/bookings/{id}', 'Admin\ApiAdminController@getBookingData');
    Route::post('admin/bookings/{id}', 'Admin\ApiAdminController@updateBookingData');
    Route::delete('admin/bookings/{id}', 'Admin\ApiAdminController@deleteBookingData');
});
