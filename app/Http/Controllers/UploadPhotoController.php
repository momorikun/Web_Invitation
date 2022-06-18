<?php

namespace App\Http\Controllers;

use App\Models\UploadsPhoto;
use App\Http\Requests\StoreUploadPhotoRequest;
use App\Http\Requests\UpdateUploadPhotoRequest;
use Illuminate\Support\Facades\Auth;

class UploadPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUploadPhotoRequest $request)
    {
        //FIXME:写真が選択されずにsubmitされた時に遷移する画面へのルーティング
        if(empty($request->file('file'))) {    
            return redirect('no_photo_selected');
        }
        
        //画像を保存する
        // $request->file('file')->store('');

        $validation = $request->validate([
            //TODO: 画像ファイルに対するバリデーションチェックをかける
            'file' => ['required'],
        ]);
        
        // $file_path = Storage::putFile('/uploads_photo', $request->file('file'), 'public');
        $upload_photo = new UploadsPhoto();
        $upload_files = $request->file('file');  

        foreach($upload_files as $file) {
            $file_name = $request->file('file')->getClientOriginalName();
            $file_path = $file->store('uploads_photo', 'public');
            $upload_photo->upload_user_id = Auth::User()->user_categories_id;
            $upload_photo->save();
        }        
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(UploadsPhoto $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(UploadsPhoto $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUploadRequest  $request
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUploadPhotoRequest $request, UploadsPhoto $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadsPhoto $upload)
    {
        //TODO:画像物理削除
    }
}
