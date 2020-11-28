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
    Route::get('lab', 'HomeController@lab')->name('lab');

    Route::post('user-doctor','UserDoctorController@addUserDoctor')->name('user-doctor');
    Route::post('user-doctor-show','UserDoctorController@showUserDoctor')->name('user-doctor-show');

    Route::post('get-work-place','UserDoctorController@getWorkplaceForDoctor')->name('get-work-place');
    Route::post('delete-doctor','UserDoctorController@deleteDoctor')->name('delete-doctor');

    Route::post('users-update', 'UserDoctorController@userUpdate')->name('users-update');

    Route::post('reservations-create', 'ReservationsController@createReservation')->name('reservations-create');
    Route::post('reservations-delete', 'ReservationsController@deleteReservation')->name('reservations-delete');

    Route::get('api-get-doctors', 'ApiController@getDoctors')->name('api-get-doctors');
    Route::get('api-get-doctorsInfo', 'ApiController@getDoctorsInfo')->name('api-get-doctorsInfo');
    Route::get('api-get-freeSlots', 'ApiController@getFreeSlots')->name('api-get-freeSlots');
    Route::post('api-bookSlot', 'ApiController@bookSlot')->name('api-bookSlot');
    Route::post('api-cancelBookSlot', 'ApiController@cancelBookedSlot')->name('api-cancelBookSlot');
    Route::post('api-requestPerscription', 'ApiController@requestPerscription')->name('api-requestPerscription');
    Route::post('api-cancelPerscription', 'ApiController@cancelPerscription')->name('api-cancelPerscription');
    Route::get('api-requestFreeLabSlots', 'ApiController@getLabSlots')->name('api-requestFreeLabSlots');

    Route::post('addPerscription', 'PerscriptionsController@addPerscription')->name('addPerscription');
    Route::post('removePerscription', 'PerscriptionsController@removePerscription')->name('removePerscription');
});
