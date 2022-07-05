<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ceremony;
use App\Models\Answer;
use App\Models\Message;
use App\Models\User;
use App\Models\Question;
use App\Http\Requests\answer_for_attendanceRequest;
use App\Http\Requests\answer_questionsRequest;
use App\Models\UploadsPhoto;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceremony_info = Ceremony::WHERE('ceremony_id', Auth::User()->ceremonies_id)->first();
        return view('dashboard', compact('ceremony_info'));
    }

    /**
     * 座席表確認のページ
     * @return \Illuminate\Http\Response
     */
    public function seating_chart(){
        $seating_chart = UploadsPhoto::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('is_seating_chart', 1)->first();
        return view('seating_chart', compact('seating_chart'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
     * 出席確認
     * @param Request $request
     * @return void
     */
    public function answer_for_attendance(answer_for_attendanceRequest $request){

        $attend_flg = $request->only(['attendance']);

        User::WHERE('ceremonies_id', Auth::User()->ceremonies_id)->WHERE('email', Auth::User()->email)->update([
            'is_answered'    => 1,
            'plan_to_attend' => $attend_flg['attendance'], 
        ]);

        return redirect('dashboard');
    }

    /**
     * 新郎新婦についてのページ
     * 
     * @return \Illuminate\Http\Response
     */
    public function about_us(){
        $groom_answer = Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('upload_user_type', 0)->get();
        $bride_answer = Answer::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->WHERE('upload_user_type', 1)->get();
        $ceremony_info= Ceremony::WHERE('ceremony_id', Auth::User()->ceremonies_id)->first();
        if($groom_answer !== null && $bride_answer !== null && $ceremony_info != null ){
            return view('about_us', compact('groom_answer', 'bride_answer', 'ceremony_info'));
        } else {
            return view('no_info');
        }
    }

    /**
     * ゲストへの質問に回答するページ
     * @return Response
     */
    public function question_for_guest(){
        $questions = Question::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)->paginate(12);

        return view('question_for_guest', compact('questions'));
    }
    /**
     * 回答をDBに登録する処理
     * @param answer_questionsRequest $request
     */
    public function answer_questions(answer_questionsRequest $request){
        $answer = $request->only([
            'id',
            'answer_body',
        ]);

        Answer::create([
            'question_id' => $answer['id'],
            'upload_user_type' => '3',
            'answer_body' => $answer['answer_body'],
            'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
        ]);

        return back()->with('alert', '回答されました!');
    }

    /**
     * メッセージ投稿ページ
     * @return \Illuminate\Http\Response
     */
    public function message_for_couple(){
        return view('message_for_couple');
    }
    /**
     * メッセージ確認画面へ
     * @param Request $request
     * @return view
     */
    public function message_confirm(Request $request){
        $data = $request->only([
            'message_for_couple',
        ]);
        return view('message_confirm', compact('data'));
    } 

    /**
     * メッセージ投稿
     * @param Request $request
     * @return void
     */
    public function message_send(Request $request){
        $request->validate([
            'message_for_couple' => ['required', 'string'],
        ]);
        $message = $request->only([
            'message_for_couple'
        ]);
        Message::create([
            'upload_user_name' => Auth::User()->name,
            'upload_user_email'=> Auth::User()->email,
            'message_body'     => $message['message_for_couple'],
            'ceremony_id'      => Auth::User()->ceremonies_id,
        ]);

        return redirect('dashboard');
    }
    
}
