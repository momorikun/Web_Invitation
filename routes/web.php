<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UploadPhotoController;
use App\Http\Controllers\Auth\QrCheckInController;
use App\Models\UploadPhoto;
use App\Models\Ceremony;
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

Route::get('/', [GuestController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', [GuestController::class, 'index'])->middleware(['auth'])->name('dashboard');

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

        //アルバム掲示関連
        Route::resource('/upload_photo', 'UploadPhotoController')->name('store', 'upload_photo');

        //ふたりへの質問関連
        Route::post('/Q_and_A_for_Groom', [AdminController::class, 'Q_and_A_for_Groom'])->name('Q_and_A_for_Groom');
        Route::post('/Q_and_A_for_Bride', [AdminController::class, 'Q_and_A_for_Bride'])->name('Q_and_A_for_Bride');

        //ゲストへの質問関連
        Route::post('/QuestionForGuest', 'AdminController@QuestionForGuest')->name('QuestionForGuest');
        Route::post('/delete_question', [AdminController::class, 'delete_question'])->name('delete_question');

        //回答一覧ページ
        Route::get('/answers', [AdminController::class, 'answers'])->name('answers');

        //メッセージ確認
        Route::get('/message_page', [AdminController::class, 'message_page'])->name('message_page');
    }
);
Route::group(
    [
        'prefix' => '/guest', 
        'middleware' => ['auth']
    ], function(){
        Route::get('/', [GuestController::class, 'index'])->middleware(['auth'])->name('dashboard');
        
        //出席確認
        Route::post('answer_for_attendance', [GuestController::class, 'answer_for_attendance'])->middleware(['auth'])->name('answer_for_attendance');

        //座席表ページ
        Route::get('seating_chart', [GuestController::class, 'seating_chart'])->name('seating_chart');

        //新郎新婦についてページ
        Route::get('about_us', [GuestController::class, 'about_us'])->name('about_us');

        //質問ページ
        Route::get('question_for_guest', [GuestController::class, 'question_for_guest'])->name('question_for_guest');
        Route::post('answer_questions', [GuestController::class, 'answer_questions'])->name('answer_questions');

        //アルバム掲示関係
        Route::get('/album_page', [UploadPhotoController::class, 'index'])->name('album_page');
        Route::post('/delete_photos', [UploadPhotoController::class, 'delete_photos'])->name('delete_photos');

        //QRコードページ
        Route::get('/qrcode_for_checkin', [QrCheckInController::class, 'checkin_page'])->name('qrcode_for_checkin');

        //メッセージ投稿
        Route::get('/message_for_couple', [GuestController::class, 'message_for_couple'])->name('message_for_couple');
        Route::post('/message_confirm', [GuestController::class, 'message_confirm'])->name('message_confirm');
        Route::get('/message_send', [GuestController::class, 'message_send'])->name('message_send');
    }
);

require __DIR__.'/auth.php';
