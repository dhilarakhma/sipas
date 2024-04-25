<?php

use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\Masuk::class)->group(function () {

    Route::get('/dashboard', 'AutentikasiController@dashboard')->name('dashboard');
    Route::get('/profil', 'AutentikasiController@profil')->name('profil');
    Route::put('/profil', 'AutentikasiController@perbaruiProfil')->name('profil.update');
    Route::get('/pengaturan', 'AutentikasiController@pengaturan')->name('pengaturan')->middleware(\App\Http\Middleware\HanyaSuperAdmin::class);
    Route::put('/pengaturan', 'AutentikasiController@updatePengaturan')->middleware(\App\Http\Middleware\HanyaSuperAdmin::class);
    Route::get('/keluar', 'AutentikasiController@keluar')->name('keluar');
    Route::resource('contoh', 'ContohController');
});

Route::get('/masuk', 'AutentikasiController@formMasuk')->name('masuk');
Route::post('/masuk', 'AutentikasiController@masuk');
Route::get('/daftar', 'AutentikasiController@formDaftar')->name('daftar');
Route::post('/daftar', 'AutentikasiController@daftar');
Route::get('/', 'AutentikasiController@index');
