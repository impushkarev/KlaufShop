<?php

Route::get('/', 'GuestController@index')->name('home');
Route::get('/accounts', 'GuestController@accounts')->name('accounts');
Route::get('/accounts/{game}', 'GuestController@accounts_game')->name('accounts_g');
Route::get('/accounts/{game}/{account}', 'GuestController@accounts_item')->name('accounts_i');
//Route::get('/boost', 'GuestController@boost')->name('boost');
Route::get('/cases', 'GuestController@cases')->name('cases');
Route::get('/cases/{case}', 'GuestController@cases_item')->name('cases_i');
//Route::get('/reviews', 'GuestController@reviews')->name('reviews');
Route::get('/about-us', 'GuestController@about')->name('about');
Route::get('/faq', 'GuestController@faq')->name('faq');
Route::get('/vk', 'UserController@vk')->name('vk');
Route::post('/pay', 'UserController@pay')->name('pay');

Route::get('/login', function() {
    return redirect('https://oauth.vk.com/authorize?client_id=7264964&display=page&redirect_uri=https://klaufshop.ru/vk&scope=groups&response_type=code&v=5.103');
})->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    
    Route::post('/accounts/{game}/{account}/b', 'GuestController@accounts_buy')->name('accounts_i_b');
    Route::post('/cases/{case}/s', 'GuestController@cases_spin')->name('cases_s');
    
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/profile/payment', 'UserController@payment')->name('payment');
    //Route::get('/profile/settings', 'UserController@settings')->name('profile_settings');
    Route::post('/pay/create', 'UserController@c_pay')->name('pay_c');


    Route::group(['middleware' => 'admin'], function() {

        Route::get('/admin', 'AdminController@admin')->name('admin');

        Route::get('/admin/users', 'AdminController@users')->name('admin_users');

        Route::post('/admin/account/create', 'AccountController@create')->name('admin_account_create');
        Route::post('/admin/account/{account}/update', 'AccountController@update')->name('admin_account_update');
        Route::post('/admin/account/{account}/delete', 'AccountController@delete')->name('admin_account_delete');

        Route::post('/admin/case/create', 'CaseController@create')->name('admin_case_create');
        Route::post('/admin/case/{case}/update', 'CaseController@update')->name('admin_case_update');
        Route::post('/admin/case/{case}/delete', 'CaseController@delete')->name('admin_case_delete');

    });
    
});