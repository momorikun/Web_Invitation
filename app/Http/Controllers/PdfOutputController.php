<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Place;
use App\Models\Ceremony;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfOutputController extends Controller
{
    public function output(Request $request) {
        $admins = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)->WHERE('user_categories_id', 1);
        $guests = User::WHERE('user_categories_id', 2)->WHERE('plan_to_attend', 1)->orderby('kana', 'asc')->WHERE('ceremonies_id', Auth::User()->ceremonies_id)->get();
        $ceremony = Ceremony::WHERE('ceremony_admin_id', Auth::User()->id)->get();
        
        $pdf = PDF::loadView('attend_pdf' , compact('admins', 'guests', 'ceremony'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
