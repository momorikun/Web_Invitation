<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UploadsPhoto;
use App\Models\Ceremony;
use App\Models\Answer;
use App\Http\Requests\guestInfoUpdateRequest;
use App\Http\Requests\getSearchedGuestRequest;
use App\Http\Requests\Question_for_Bride_Request;
use App\Http\Requests\Question_for_Groom_Request;
use App\Http\Requests\QuestionForGuestRequest;
use App\Http\Requests\uploadWeddingInfoRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //渡す情報
        $users = User::WHERE('user_categories_id', 1)->orderby('created_at', 'desc')->get();
        $uploads_photos = UploadsPhoto::WHERE('upload_user_email', Auth::User()->email)->WHERE('is_seating_chart', 0)->orderby('created_at', 'desc')->get();
        $seating_img = UploadsPhoto::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('is_seating_chart', 1)->first();
        $ceremony_info = Ceremony::WHERE('ceremony_id', Auth::User()->ceremonies_id)->first();

        return view('admin', compact('users', 'uploads_photos', 'seating_img', 'ceremony_info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(guestInfoUpdateRequest $request)
    {
        $updateData = $request->only([
            'updateName',
            'updateKana',
            'updateEmail',
            'updateId',
            'updateGiftMoney',
            'updateRemarks',
        ]);

        try{
            User::WHERE('ceremonies_id', $updateData['updateId'])->WHERE('email', $updateData['updateEmail'])->update([
                'name' => $updateData['updateName'],
                'kana' => $updateData['updateKana'],
                'gift_money'    => $updateData['updateGiftMoney'],
                'remarks'       => $updateData['updateRemarks'],
            ]);
        } catch (Exception $e) {
            echo($e->message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Encode the text from input
     * 
     * @param string $text
     * @return string $encodedText
     */
    public static function encode(Request $request){
        $received_text = $request->text;
        $web_system_url = "こちらで新規登録をしてからご返信ください: <URL>"; //TODO:<URL>にURLを貼り付ける
        $received_add_text = "結婚式IDはこちらをご入力ください:　".$request->send_ceremony_id;
        $getEncodeText =  $received_text."\n".$received_add_text."\n"."\n".$web_system_url;
        $encodedText = urlencode($getEncodeText);

        return redirect("https://line.me/R/share?text={$encodedText}");
    }


    public function getSearchedGuest(getSearchedGuestRequest $request){
        $data = $request->only(['id', 'kana']);
        $guests = User::WHERE('kana', $data['kana'])->WHERE('ceremonies_id', $data['id'])->get();
        
        return response()->json($guests);
    }

    /**
     * 挙式情報掲載
     *
     * @param uploadWeddingInfoRequest $request
     * @return void
     */
    public function upload_wedding_info(uploadWeddingInfoRequest $request){
        $data = $request->only([
            'upload_user_ceremony_id',
            'ceremonies_dates_year',
            'ceremonies_dates_month',
            'ceremonies_dates_day',
            'ceremonies_dates_time',
            'place_name',
            'place_state',
            'place_city',
            'place_address_line',
        ]);
        $address_elem = $request->only(['place_state', 'place_city', 'place_address_line']);
        $address = implode($address_elem);
        
        $date_elem = $request->only(['ceremonies_dates_year', 'ceremonies_dates_month', 'ceremonies_dates_day']);
        $time = $data['ceremonies_dates_time'];
        $date_str = implode("-", $date_elem)." ".$time;

        $exist = Ceremony::WHERE('ceremony_id', $data['upload_user_ceremony_id'])->get();

        if(count($exist) > 0) {
            Ceremony::WHERE('ceremony_id', $data['upload_user_ceremony_id'])->update([
                'place_name' => $data['place_name'],
                'address' => $address,
                'date_and_time' => $date_str,
            ]);
        } else {
            Ceremony::create([
                'ceremony_id'  => $data['upload_user_ceremony_id'],
                'place_name'   => $data['place_name'],
                'address'      => $address,
                'date_and_time'=> $date_str,
            ]);
        }
        
        return back();
        // return view('test', compact('dates'));
        // TODO: ジオコーディングAPIに住所を投げる　https://map.yahooapis.jp/geocode/V1/geoCoder?appid=<あなたのアプリケーションID>&query=%e6%9d%b1%e4%ba%ac%e9%83%bd%e6%b8%af%e5%8c%ba%e5%85%ad%e6%9c%ac%e6%9c%a8
    }

    /**
     * 新郎の答え
     *
     * @param Question_for_Groom_Request $request
     * @return void
     */
    public function Q_and_A_for_Groom(Question_for_Groom_Request $request){
        $data = $request->only([
            'Q1forGroom',
            'Q2forGroom',
            'Q3forGroom',
            'Q4forGroom',
        ]);

        $exist = Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)
        ->WHERE('upload_user_type', 0)
        ->get();

        if(count($exist) > 0){
            foreach($data as $item){
                Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)
                ->WHERE('upload_user_type', 0)
                ->update([
                    'answer_body' => $item['Q1forGroom'],
                    'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
                ]);
            }
        } else {
            foreach($data as $item){
                Answer::create([
                    'upload_user_type' => 0,
                    'answer_body' => $item,
                    'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
                ]);
            }
        }
        return back();
        
    }
    /**
     * 新婦の答え
     *
     * @param Question_for_Bride_Request $request
     * @return void
     */
    public function Q_and_A_for_Bride(Question_for_Bride_Request $request){
        $data = $request->only([
            'Q1forBride',
            'Q2forBride',
            'Q3forBride',
            'Q4forBride',
        ]);

        $exist = Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)
        ->WHERE('upload_user_type', 1)
        ->get();

        if(count($exist) > 0){
            foreach($data as $item){
                Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)
                ->WHERE('upload_user_type', 1)
                ->update([
                    'answer_body' => $item,
                    'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
                ]);
            }
        } else {
            foreach($data as $item){
                Answer::create([
                    'upload_user_type' => 1,
                    'answer_body' => $item,
                    'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
                ]);
            }
        } 
        return back();
    }
    /**
     * ゲストへの質問
     *
     * @param QuestionForGuestRequest $request
     * @return void
     */
    
    public function QuestionForGuest(QuestionForGuestRequest $request){
        $data = $request->only([
            'Q1forGuest',
            'Q2forGuest',
            'Q3forGuest',
            'Q4forGuest',
            'Q5forGuest',
        ]);

        foreach($data as $item){
            Question::create([
                'upload_user_email' => Auth::User()->email,
                'question_body' => $item,
                'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
            ]);
        }
        return back();
    }
}
