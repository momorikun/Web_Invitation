<?php

namespace App\Http\Controllers;

use App\Models\UploadsPhoto;
use App\Http\Requests\StoreUploadPhotoRequest;
use App\Http\Requests\UpdateUploadPhotoRequest;
use App\Http\Requests\delete_photosRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class UploadPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //渡す情報
        $photos = UploadsPhoto::WHERE('upload_user_ceremony_id', Auth::User()->ceremonies_id)
                  ->WHERE('is_seating_chart', 0)->WHERE('deleted_at', null)->paginate(12);
        if($photos[0] != null) {
            return view('albums_page', compact('photos'));
        } else {
            return view('no_info');
        }
        
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
        $upload_files = $request->file('files');  

        foreach($upload_files as $index => $element) {
            $date = date("YmdHis");
            $own_ceremony_id = Auth::User()->ceremonies_id;
            $extension = $element['photo']->guessExtension();
            $file_name = "{$own_ceremony_id}_{$date}_{$index}.{$extension}";
            $file_path = $element['photo']->storeAs('uploads_photo', $file_name);

            UploadsPhoto::create([
                'upload_user_email' => Auth::User()->email,
                'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
                'photo_path' => $file_path,
                'is_seating_chart' => 0,
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
     * @param  Request
     */
    public function delete_photos(delete_photosRequest $request)
    {
        $path = $request->photo_path;
        
        UploadsPhoto::WHERE('photo_path', $request->photo_path)->delete();
        Storage::disk('public')->delete($path);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSeatingChartImg(StoreUploadPhotoRequest $request){
        if($request['file'] === null) {
            return back()->with('message', '画像を選択してください。');
        };

        $upload_file = $request->file('file');
        $own_ceremony_id = Auth::User()->ceremonies_id;
        $extension = $upload_file->guessExtension();
        $file_name = "{$own_ceremony_id}_seating_chart.{$extension}";

        $exist = UploadsPhoto::WHERE('upload_user_email', $request->upload_user_email)
            ->WHERE('is_seating_chart', 1)
            ->first();
            
        if($exist){
            //座席表は1枚のみ保存しストレージの圧迫を防ぐ
            //ディスク上から削除
            $old_photo = UploadsPhoto::WHERE('upload_user_ceremony_id', $own_ceremony_id)
            ->WHERE('is_seating_chart', 1)->first();
            
            Storage::disk('public')->delete($old_photo['photo_path']);
        }

        //ディスク上に保存
        $file_path = $upload_file->storeAs('seating_chart', $file_name);

        
        if($exist == null){           
            UploadsPhoto::create([
                'upload_user_email' => Auth::User()->email,
                'upload_user_ceremony_id' => Auth::User()->ceremonies_id,
                'photo_path' => $file_path,
                'is_seating_chart' => 1,
            ]);
        }
        
        return back();
    }

    /**
     * 座席表の削除
     *
     * @param Request $request
     * @return void
     */
     public function deleteSeatingChart(Request $request){
        $target_photo = UploadsPhoto::WHERE('upload_user_ceremony_id', $request->upload_user_ceremony_id)
            ->WHERE('is_seating_chart', 1)->first();
        Storage::disk('public')->delete($target_photo['photo_path']);
        UploadsPhoto::WHERE('upload_user_ceremony_id', $request->upload_user_ceremony_id)->delete();

        return back();
     }
}
