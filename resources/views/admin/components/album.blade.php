{{-- アルバム掲示セクション --}}
<div id="album" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
    <h2 class="border-b border-grey-400">アルバム掲示</h2>
    <div class="p-0 mt-4 bg-white">
        @if (count($errors->uploadPhoto) > 0)
            <div>   
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->uploadPhoto->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- post先はname指定。resourceで自動生成される。php artisan route:listで確認 --}}
        <form method="POST" action="{{ route('upload_photo') }}" enctype="multipart/form-data" class="block">
            @csrf
            <input type="file" name="files[][photo]" multiple>
            <input type="hidden" name="upload_user_id" value="{{ Auth::User()->id }}">
            <div class="p-6 bg-white flex justify-center w-full">
                <button type="submit" class="btn btn-active btn-ghos mr-1">アップロード</button>
                <a href="{{ route('album_page') }}" class="btn btn-outline ml-1">写真一覧へ</a>
            </div>
        </form>
        
    </div>
</div>