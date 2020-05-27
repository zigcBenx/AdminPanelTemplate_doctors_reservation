<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

//    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
//
//    Route::resource('products', 'ProductsController');

    Route::get('reservations_control','HomeController@reservations')->name('reservations_control.show');
    Route::get('reserve','HomeController@reserve')->name('reserve.show');

    Route::get('recepti','HomeController@recepti')->name('recepti');
    Route::get('pregledi','HomeController@pregledi')->name('pregledi');

    Route::post('user-doctor','UserDoctorController@addUserDoctor')->name('user-doctor');
    Route::post('user-doctor-show','UserDoctorController@showUserDoctor')->name('user-doctor-show');
});
