{{-- 座席アップロードセクション --}}
<div id="seating-chart" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
    <h2 class="border-b border-grey-400">座席表アップロード</h2>
    @if(session()->has('message'))
        <div class="mt-3 list-disc list-inside text-sm text-red-600">
            {{session('message')}}
        </div>
    @endif
    @if (count($errors->storeSeatingChartImg) > 0)
            <div>           
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->storeSeatingChartImg->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form method="POST" action="{{ route('upload_seating_chart') }}" enctype="multipart/form-data" class=" w-full">
        @csrf
            <input type="file" name="file" class="mt-5">
            <input type="hidden" name="upload_user_email" value="{{ Auth::User()->email }}">
        <div class="p-6 bg-white flex justify-center w-full">
            <button type="submit" class="btn btn-active btn-ghos">画像アップロード</button>
        </div>
    </form>
    @if ($seating_img)
    
    <div class="flex w-full justify-center">
        <img src="{{ asset('storage/'.$seating_img->photo_path) }}" alt="座席表は主催者までご確認ください" class="object-cover show_pop cursor-pointer">
        <div class="modal_pop hidden w-screen h-screen position-fixed top-0 left-0 z-30">
            <div class="bg js-modal-close bg-slate-500 w-full h-full position-fixed z-40"></div>
            <div class="modal_pop_main">
                <img src="{{ asset('storage/'.$seating_img->photo_path) }}" alt="座席表は主催者までご確認ください" class="object-cover popup-image position-absolute h-5/6  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-50">
            </div>
        </div>
    </div>    
    <div class="w-full flex justify-end mt-5">
        <form action="{{ route('delete_seating_chart') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $seating_img->upload_user_ceremony_id }}" name="upload_user_ceremony_id">
        <button type="submit" class="btn btn-active btn-ghos">画像を削除</button>
        </form>
    </div>
    @endif
    
</div>
