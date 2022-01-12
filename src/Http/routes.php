<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('aba/standard')->group(function () {

        Route::get('/redirect', 'Webkul\Aba\Http\Controllers\StandardController@redirect')->name('aba.standard.redirect');

        Route::get('/success', 'Webkul\Aba\Http\Controllers\StandardController@success')->name('aba.standard.success');

        Route::get('/cancel', 'Webkul\Aba\Http\Controllers\StandardController@cancel')->name('aba.standard.cancel');

        Route::get('/credit/redirect', 'Webkul\Aba\Http\Controllers\StandardController@creditRedirect')->name('credit.standard.redirect');

    });

    
});

// Route::get('aba/standard/ipn', 'Webkul\Aba\Http\Controllers\StandardController@ipn')->name('aba.standard.ipn');
Route::post('aba/standard/ipn', 'Webkul\Aba\Http\Controllers\StandardController@ipn')->name('aba.standard.ipn');
