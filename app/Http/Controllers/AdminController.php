<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UploadsPhoto;
use App\Models\Ceremony;
use App\Models\Answer;
use App\Models\Message;
use App\Http\Requests\guestInfoUpdateRequest;
use App\Http\Requests\getSearchedGuestRequest;
use App\Http\Requests\Question_for_Bride_Request;
use App\Http\Requests\Question_for_Groom_Request;
use App\Http\Requests\QuestionForGuestRequest;
use App\Http\Requests\uploadWeddingInfoRequest;
use App\Http\Requests\delete_questionRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

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
        $uploads_photos = UploadsPhoto::WHERE('upload_user_email', Auth::User()->email)->WHERE('is_seating_chart', 0)->orderby('created_at', 'desc')->get();
        $seating_img = UploadsPhoto::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('is_seating_chart', 1)->first();
        $ceremony_info = Ceremony::WHERE('ceremony_id', Auth::User()->ceremonies_id)->first();
        $groom_answers = Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('upload_user_type', 0)->get();
        $bride_answers = Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('upload_user_type', 1)->get();
        $questions = Question::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('deleted_at', null)->paginate(5);

        return view('admin', compact('uploads_photos', 'seating_img', 'ceremony_info', 'groom_answers', 'bride_answers', 'questions'));
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
        
        $data = $request->all();

        if(isset($data['kana'])) {
            $guests = User::WHERE('kana', $data['kana'])->WHERE('ceremonies_id', $data['id'])->get();
        } 
        if(isset($data['gender']) || isset($data['whichSide']) || isset($data['relationship'])) {
            if(isset($data['gender']) && isset($data['whichSide']) && isset($data['relationship'])) {
                $guests = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)
                ->WHERE('gender', $data['gender'])
                ->WHERE('is_bride_side', $data['whichSide'])
                ->WHERE('relationship', $data['relationship'])
                ->get();
            } elseif (isset($data['gender']) && isset($data['whichSide'])) {
                $guests = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)
                ->WHERE('gender', $data['gender'])
                ->WHERE('is_bride_side', $data['whichSide'])
                ->get();
            } elseif (isset($data['whichSide']) && isset($data['relationship'])) {
                $guests = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)
                ->WHERE('is_bride_side', $data['whichSide'])
                ->WHERE('relationship', $data['relationship'])
                ->get();
            } elseif (isset($data['gender']) && isset($data['relationship'])) {
                $guests = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)
                ->WHERE('gender', $data['gender'])
                ->WHERE('relationship', $data['relationship'])
                ->get();
            } elseif (isset($data['gender'])) {
                $guests = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)
                ->WHERE('gender', $data['gender'])
                ->get();
            } elseif (isset($data['whichSide'])) {
                $guests = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)
                ->WHERE('is_bride_side', $data['whichSide'])
                ->get();
            } elseif (isset($data['relationship'])) {
                $guests = User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)
                ->WHERE('relationship', $data['relationship'])
                ->get();
            }     
        }
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
            'groom_name',
            'bride_name',
            'attendance_contact_limit_day',
            'ceremonies_dates_year',
            'ceremonies_dates_month',
            'ceremonies_dates_day',
            'ceremonies_reception_time',
            'start_ceremonies_time',
            'start_wedding_reception_time',
            'place_state',
            'place_city',
            'place_address_line',
            'place_name',
        ]);
        $address_elem = $request->only(['place_state', 'place_city', 'place_address_line']);
        $address = implode($address_elem);
        
        $date_elem = $request->only(['ceremonies_dates_year', 'ceremonies_dates_month', 'ceremonies_dates_day']);
        $date_str = $date_elem['ceremonies_dates_year']."年".$date_elem['ceremonies_dates_month']."月".$date_elem['ceremonies_dates_day']."日";

        $exist = Ceremony::WHERE('ceremony_id', Auth::User()->ceremonies_id)->get();

        $marge_units_n_limit = [];
        $units = ['年', '月', '日'];
        $limit = explode('-' ,$data['attendance_contact_limit_day']);
        for($i = 0; $i < count($units); ++$i){
            $marge_units_n_limit[] = $limit[$i];
            $marge_units_n_limit[] = $units[$i];
        }
        $marge_result = implode($marge_units_n_limit);
        
        if(count($exist) > 0) {
            Ceremony::WHERE('ceremony_id', Auth::User()->ceremonies_id)->update([
                'groom_name'   => $data['groom_name'],
                'bride_name'   => $data['bride_name'],
                'attendance_contact_limit_day' => $marge_result,
                'wedding_date' => $date_str,
                'reception_time' => $data['ceremonies_reception_time'],
                'start_ceremony_time' => $data['start_ceremonies_time'],
                'start_wedding_reception_time' => $data['start_wedding_reception_time'],
                'place_name'   => $data['place_name'],
                'address'      => $address,
            ]);
        } else {
            Ceremony::create([
                'ceremony_id'  => Auth::User()->ceremonies_id,
                'groom_name'   => $data['groom_name'],
                'bride_name'   => $data['bride_name'],
                'attendance_contact_limit_day' => $marge_result,
                'wedding_date' => $date_str,
                'reception_time' => $data['ceremonies_reception_time'],
                'start_ceremony_time' => $data['start_ceremonies_time'],
                'start_wedding_reception_time' => $data['start_wedding_reception_time'],
                'place_name'   => $data['place_name'],
                'address'      => $address,
                'wedding_date'=> $date_str,
            ]);
        }
        
        return back();
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
            Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)
            ->WHERE('upload_user_type', 0)
            ->delete();
        } 

        foreach($data as $item){
            Answer::create([
                'upload_user_type' => 0,
                'answer_body' => $item,
                'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
            ]);
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
            Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)
            ->WHERE('upload_user_type', 1)
            ->delete();
        } 
        foreach($data as $item){
            Answer::create([
                'upload_user_type' => 1,
                'answer_body' => $item,
                'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
            ]);
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
            if($item == null) break;
            Question::create([
                'upload_user_email' => Auth::User()->email,
                'question_body' => $item,
                'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
            ]);
        }
        return back();
    }

    /**
     * ゲストへの質問削除
     * 
     * @param Request $request
     * @return void
     */
    public function delete_question(delete_questionRequest $request){
        
        $target = $request->only([
            'delete_target_id',
            'delete_target_body',
        ]);
        Question::WHERE('id', $target)->delete();
        return back();
    }

    /**
     * ゲストからの回答を見るページ
     * @return Response
     */
    public function answers(){
        $answers = Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('upload_user_type', 3)->get();
        $questions = Question::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->get();
        $items = Question::WHERE('questions.upload_user_ceremony_id', Auth::User()->ceremonies_id)->JOIN('answers', 'questions.id', '=', 'answers.question_id')->get();
        
        return view('answers', compact('items', 'questions', 'answers'));
    }

    /**
     * ゲストからのメッセージ確認
     * @return response
     */
    public function message_page(){
        $messages = Message::WHERE('ceremony_id', Auth::User()->ceremonies_id)->get();
        return view('message_page', compact('messages'));
    }
}
