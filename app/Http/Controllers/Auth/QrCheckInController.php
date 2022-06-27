<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrCheckInController extends Controller
{
    public function showQrReader() {
        return view('qr_code_reader_mode');
    }
}
