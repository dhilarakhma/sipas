<?php

Route::get('/arsip/{jenis_dokumen}', 'ArsipController@index')->name('arsip');
Route::get('/arsip/{jenis_dokumen}/tambah', 'ArsipController@create')->name('arsip.create');
Route::post('/arsip/{jenis_dokumen}', 'ArsipController@store')->name('arsip.store');
Route::get('/arsip/{jenis_dokumen}/unduh/{arsip}', 'ArsipController@unduh')->name('arsip.unduh');
Route::resource('kantor', 'KantorController')->middleware(\App\Http\Middleware\HanyaSuperAdmin::class);