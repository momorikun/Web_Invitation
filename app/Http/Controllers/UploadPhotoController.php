<?php

namespace App\Http\Controllers;

use App\Models\UploadsPhoto;
use App\Http\Requests\StoreUploadPhotoRequest;
use App\Http\Requests\UpdateUploadPhotoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            //TODO: 画像ファイルに対するバリデーションチェックをかける
            'files.*.upload_photo' => 'image|mimes:jpeg,bmp,png',
        ]);
    
        $upload_files = $request->file('files');  

        foreach($upload_files as $index => $element) {
            $own_email = Auth::User()->email;
            $extension = $element['photo']->guessExtension();
            $file_name = "{$own_email}_{$index}.{$extension}";
            $file_path = $element['photo']->storeAs('uploads_photo', $file_name);

            UploadsPhoto::create([
                'upload_user_email' => Auth::User()->email,
                'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
                'photo_path' => $file_path,
                'is_seating_chart_img' => 0,
            ]);
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
        $path = $upload->photo_path;
        //TODO:画像物理削除
        Storage::disk('uploads_photo')->delete($path);
    }
}
