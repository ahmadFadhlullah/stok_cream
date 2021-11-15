<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'Users@index')->name('home');
Route::get('/', 'Users@index')->name('index');
Route::get('/home/tabelcream','Users@tabel_cream')->name('tabel_cream');
Route::post('/home/tabelcream','Users@tambah_cream')->name('tambah_cream');
Route::get('/home/editcream/{id}', 'Users@edit_cream')->name('edit_cream');
Route::post('/home/updatecream', 'Users@update_cream')->name('update_cream');
Route::post('/home/editcream/{id}', 'Users@update_stok_cream')->name('update_stok_cream');

Route::get('/home/pembelian', 'Users@pembelian')->name('pembelian');
Route::post('/home/pembelian', 'Users@pembelianForm')->name('pembelian.proses');
Route::post('/home/pembelian/hapus', 'Users@hapusPembeli')->name('hapus_pembeli');
Route::get('/home/pembeli/{id}', 'Users@editPembeli')->name('edit_pembeli');
Route::post('/home/pembeli/edit/{id}','Users@editPembeliForm')->name('edit_pembeli_form');
Route::get('/home/laporan', 'Users@buatLaporan')->name('halaman_laporan');
Route::post('/home/laporan','Users@cetakLaporan')->name('cetak_laporan');
Route::get('/home/stokmenipis', 'Users@stokMenipis')->name('stok_menipis');
// aksi cream
Route::post('/home/tablecream','Users@hapus_cream')->name('hapus_cream');

// Route::get('/home', 'HomeController@index')->name('home');

// profil
Route::get('/home/profile', 'Users@profile')->name('user.profile');
Route::post('/home/profil/foto', 'Users@ubahFoto')->name('ubah.foto');
Route::post('/home/profile', 'Users@ubahProfil')->name('ubah.profil');