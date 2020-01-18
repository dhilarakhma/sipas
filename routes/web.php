<?php

Route::get('/arsip/{jenis_dokumen}', 'ArsipController@index')->name('arsip');
Route::get('/arsip/{jenis_dokumen}/tambah', 'ArsipController@index')->name('arsip.create');