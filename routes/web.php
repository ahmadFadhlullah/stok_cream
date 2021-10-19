<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'Users@index')->name('home');
Route::get('/', 'Users@index')->name('index');
Route::get('/home/tabelcream','Users@tabel_cream')->name('tabel_cream');
// aksi cream
Route::post('/home/tablecream','Users@hapus_cream')->name('hapus_cream');

// Route::get('/home', 'HomeController@index')->name('home');

// profil
Route::get('/home/profile', 'Users@profile')->name('user.profile');
Route::post('/home/profil/foto', 'Users@ubahFoto')->name('ubah.foto');
Route::post('/home/profile', 'Users@ubahProfil')->name('ubah.profil');