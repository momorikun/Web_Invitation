<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UploadsPhoto;
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
        $uploads_photos = UploadsPhoto::WHERE('upload_user_id', Auth::User()->id)->orderby('created_at', 'desc')->get();
        
        return view('admin', compact('users', 'uploads_photos'));
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
    public function update(Request $request)
    {
        $request->validate([
            'updateId'        => ['required', 'string', 'min:8', 'max:50'],
            'updateName'      => ['required', 'string', 'max:255'],
            'updateKana'      => ['required', 'string', 'min:2', 'max:255'],
            'updateEmail'     => ['required', 'string', 'email', 'max:255'],
            'updateGiftMoney' => ['integer', 'nullable'],
            'updateRemarks'   => ['string', 'max:30', 'nullable'],
        ]);
        
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
        $received_text = $request->input('text');
        $received_add_text = "結婚式IDはこちらをご入力ください:　"+$request->input('send_ceremony_id');
        $getEncodeText = $received_text+"\n"+$received_add_text;
        $encodedText = urlencode($getEncodeText);

        return redirect("https://line.me/R/share?text={$encodedText}");
    }


    public function getSearchedGuest(Request $request){
        $request->validate([
            'id'   => ['required', 'string', 'min:8', 'max:50'],
            'kana' => ['required', 'string', 'min:2', 'max:255'],
        ]);
        
        $data = $request->only(['id', 'kana']);
        $guests = User::WHERE('kana', $data['kana'])->WHERE('ceremonies_id', $data['id'])->get();
        
        return response()->json($guests);
    }
}
