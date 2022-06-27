<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class QrCheckInController extends Controller
{
    /**
     * QRコードリーダー画面を返す
     *
     * @return void
     */
    public function showQrReader() {
        return view('qr_code_reader_mode');
    }

    /**
     * QRコードを読み取ったらusersテーブルの該当Userのis_attendedを1にする
     *
     * @return void
     */
    public function checkIn(Request $request){
        
        $checkInData = $request->only(['checkInData']);

        User::WHERE("uuid", $checkInData['checkInData'])->update(['is_attended' => 1]);
    }
}
