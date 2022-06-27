<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UploadPhotoController;
use App\Http\Controllers\Auth\QrCheckInController;
use App\Models\UploadPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
// TODO:写真やコメントの混合を防ぐためルーティングで/{ceremonies_id}/を入れる必要がある⇒？？？

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/qr_login', 'Auth\\QrCheckInController@login');

Route::group(
    [
        'prefix' => 'admin', 
        'middleware' => ['auth', 'can:admin']
    ], function(){
        Route::get('/', function(){
            return 'admin only';
        });
        Route::resource('/', 'AdminController')->name('index', 'admin');
        Route::resource('/upload_photo', 'UploadPhotoController')->name('store', 'upload_photo');
        Route::get('/no_photo_selected', function(){
            return view('no_photo_selected')->name('no_photo_selected');
        });
        Route::get('/attend_pdf', 'PdfOutputController@output')->name('attend_pdf');
        Route::post('/url_encode', 'AdminController@encode')->name('url_encode'); //LINEスキーマ用URLエンコード
        Route::post('/getGuest', 'AdminController@getSearchedGuest');
        Route::post('/updateGuest', 'AdminController@update');
        Route::get('/qr_code_reader_mode', [QrCheckInController::class, 'showQrReader'])->name('qr_code_reader_mode');
        Route::post('/check_in', [QrCheckInController::class, 'checkIn'])->name('checkIn');
        Route::post('/upload_wedding_info', [AdminController::class, 'upload_wedding_info'])->name('upload_wedding_info');
        Route::post('/upload_question', [AdminController::class, 'upload_question'])->name('upload_question');
    }
);
Route::group(
    [
        'prefix' => '/guest', 
        'middleware' => ['auth']
    ], function(){
        Route::get('/', function(){
            return view('dashboard');
        })->middleware(['auth'])->name('dashboard');
    }
);

require __DIR__.'/auth.php';
