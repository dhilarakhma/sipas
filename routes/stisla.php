<?php 

Route::middleware(\App\Http\Middleware\Masuk::class)->group(function(){
    
    Route::get('/dashboard', 'AutentikasiController@dashboard')->name('dashboard');
    Route::get('/profil', 'AutentikasiController@profil')->name('profil');
    Route::put('/profil', 'AutentikasiController@perbaruiProfil')->name('profil.update');
    Route::get('/pengaturan', 'AutentikasiController@pengaturan')->name('pengaturan');
    Route::put('/pengaturan', 'AutentikasiController@updatePengaturan');
    Route::get('/keluar', 'AutentikasiController@keluar')->name('keluar');
    Route::resource('contoh', 'ContohController');
    
});

Route::get('/masuk', 'AutentikasiController@formMasuk')->name('masuk');
Route::post('/masuk', 'AutentikasiController@masuk');
Route::get('/', 'AutentikasiController@index');