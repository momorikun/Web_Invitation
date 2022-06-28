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

//当日出席関連
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

        //アルバム掲示関連
        Route::resource('/upload_photo', 'UploadPhotoController')->name('store', 'upload_photo');
        
        //座席表関連
        Route::get('/upload_seating_chart', [UploadPhotoController::class, 'storeSeatingChartImg'])->name('upload_seating_chart');
        Route::post('/upload_seating_chart', [UploadPhotoController::class, 'storeSeatingChartImg'])->name('upload_seating_chart');
        Route::post('/delete_seating_chart', [UploadPhotoController::class, 'deleteSeatingChart'])->name('delete_seating_chart');

        //pdf出力関連
        Route::get('/attend_pdf', 'PdfOutputController@output')->name('attend_pdf');

        //LINE URL Schema関連
        Route::post('/url_encode', [AdminController::class, 'encode'])->name('url_encode'); //LINEスキーマ用URLエンコード

        //ゲスト検索関連
        Route::post('/getGuest', [AdminController::class, 'getSearchedGuest']);
        Route::post('/updateGuest', [AdminController::class, 'update']);

        //QRコードリーダ関連
        Route::get('/qr_code_reader_mode', [QrCheckInController::class, 'showQrReader'])->name('qr_code_reader_mode');
        Route::post('/check_in', [QrCheckInController::class, 'checkIn'])->name('checkIn');

        //挙式情報関連
        Route::post('/upload_wedding_info', [AdminController::class, 'upload_wedding_info'])->name('upload_wedding_info');

        //ゲストへの質問関連
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
