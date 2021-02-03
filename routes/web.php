<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BerandaController@beranda')->name('beranda.index');
Route::get('produk-kami', 'BerandaController@produk')->name('produk-kami.index');
Route::get('list-produk/{produk}', 'BerandaController@list_produk')->name('list-produk.category');
Route::get('list-produk-merk/{merek}', 'BerandaController@list_produk_merk')->name('list-produk-merk.merk');
Route::get('produk-detail/{slug}','BerandaController@produk_detail')->name('produk-detail.detail');
Route::get('layanan','LayananController@index')->name('layanan.index');
Route::post('layanan','LayananController@store')->name('layanan.store');
Route::get('cari','BerandaController@cari')->name('beranda.cari');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('setting-user', 'UserController@form_user')->name('setting-user.setting');
    Route::post('setting-user', 'UserController@update_form_user');

    Route::post('transaksi/{id}','TransaksiController@pesanan')->name('transaksi.pesanan');
    Route::get('check-out','TransaksiController@keranjang');
    Route::get('konfirmasi-check-out','TransaksiController@checkout')->name('konfirmasi.pesanan');
    Route::get('spesifikasi/show/{id}','TransaksiController@showSpek')->name('spesifikasi.show');
    Route::delete('check-out/{id}','TransaksiController@delete')->name('check-out.delete');

    Route::get('history','HistoryController@index')->name('history.index');
    Route::get('history/{id}','HistoryController@detail')->name('history.detail');
    Route::get('cetak-history-pesanan/{id}','CetakController@cetak_pesanan_user')->name('cetak-history-pesanan.detail');

    Route::group(['middleware' => ['admin','auth']], function(){

        Route::resource('admin','AdminController');
    
        Route::get('user-admin/setting', 'UserController@form')->name('users.setting');
        Route::post('user-admin/setting', 'UserController@update_form');
        Route::get('users/data','UserController@data')->name('users.data');
        Route::get('users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
        Route::resource('users','UserController')->except(['destroy']);
    
        Route::get('produk/data','ProdukController@data')->name('produk.data');
        Route::resource('produk','ProdukController')->except(['destroy']);
        Route::get('produk/{id}/destroy', 'ProdukController@destroy')->name('produk.destroy');
    
        Route::get('merk/data','MerkController@data')->name('merk.data');
        Route::resource('merk','MerkController')->except(['destroy']);
        Route::get('merk/{id}/destroy', 'MerkController@destroy')->name('merk.destroy');
    
        Route::get('tipe/data','TipeController@data')->name('tipe.data');
        Route::resource('tipe','TipeController')->except(['destroy']);
        Route::get('tipe/{id}/destroy', 'TipeController@destroy')->name('tipe.destroy');
    
        Route::get('hardware/data','CathardController@data')->name('hardware.data');
        Route::resource('hardware','CathardController')->except(['destroy']);
        Route::get('hardware/{id}/destroy', 'CathardController@destroy')->name('hardware.destroy');
    
        Route::get('kapasitas/data','KapasitasController@data')->name('kapasitas.data');
        Route::resource('kapasitas','KapasitasController')->except(['destroy']);
        Route::get('kapasitas/{id}/destroy', 'KapasitasController@destroy')->name('kapasitas.destroy');
    
        Route::get('layanan/pesan-masuk/data','LayananController@data')->name('layanan.data');
        Route::get('layanan/pesan-terjawab/data','LayananController@data_terjawab')->name('layanan-terjawab.data');
        Route::get('layanan/pesan-masuk','LayananController@pesan_masuk')->name('pesan-masuk.index');
        Route::get('layanan/pesan-terjawab','LayananController@pesan_terjawab')->name('pesan-terjawab.index');
        Route::resource('layanan','LayananController')->except(['destroy','index','store','edit']);
        Route::get('layanan/show-pesan-terjawab/{slug}','Layanancontroller@show_pesan_terjawab')->name('pesan-terjawab.show');
        Route::get('layanan/{id}/destroy', 'LayananController@destroy')->name('layanan.destroy');
        Route::get('konfirmasi-pesan/{id}','LayananController@konfirmasi')->name('pesan-masuk.konfirmasi');
    
        Route::get('pesanan','PesananController@admin_index')->name('pesanan-admin.index');
        Route::get('pesanan/spesifikasi/{id}','PesananController@showSpek')->name('pesanan-spesifikasi.show');
        Route::get('pesanan/data','PesananController@data')->name('pesanan.data');
        Route::get('pesanan/{id}','PesananController@show')->name('pesanan.show');
        Route::get('konfirmasi-pesanan/{id}','PesananController@konfirmasi')->name('pesanan.konfirmasi');
        Route::get('pesanan/{id}/destroy', 'PesananController@destroy')->name('pesanan.destroy');
    
        Route::get('pesanan-dirakit/data','PesananController@data_dirakit')->name('pesanan-dirakit.data');
        Route::get('pesanan-dirakit','PesananController@pesanan_dirakit_index')->name('pesanan-dirakit.index');
        Route::get('pesanan-dirakit/{id}','PesananController@show_dirakit')->name('pesanan-dirakit.show');
        Route::get('konfirmasi-pesanan-dirakit/{id}','PesananController@konfirmasi_dirakit')->name('pesanan-dirakit.konfirmasi');
    
        Route::get('pesanan-selesai/data','PesananController@data_selesai')->name('pesanan-selesai.data');
        Route::get('pesanan-selesai','PesananController@pesanan_selesai_index')->name('pesanan-selesai.index');
        Route::get('pesanan-selesai/{id}','PesananController@show_selesai')->name('pesanan-selesai.show');
        Route::get('konfirmasi-pesanan-selesai/{id}','PesananController@konfirmasi_selesai')->name('pesanan-selesai.konfirmasi');
    
        Route::get('history-pesanan/data','HistoryController@data')->name('history-pesanan.data');
        Route::get('history-pesanan','HistoryController@history_pesanan_admin')->name('history-pesanan.index');
        Route::get('history-pesanan-detail/{id}','HistoryController@history_det')->name('history-pesanan.detail');
    
        Route::get('cetak-history-detail/{id}','CetakController@cetak_detail')->name('cetak-history.detail');
    
    });    

});





// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
