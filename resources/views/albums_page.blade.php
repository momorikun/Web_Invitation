@section('title', '| アルバム')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="grid grid-cols-2 grid-rows-3 gap-2 md:grid-cols-3 w-full justify-center">
                @if ($photos)
                @foreach ($photos as $photo)
                <div class="w-full show_pop relative z-40">
                    @if (Auth::User()->user_categories_id === 1)
                    <div class="text-red-500 font-weight-bold w-5 h-5 top-0 left-0 bg-white border-2 position-absolute cursor-pointer hidden z-50 delete_target">
                        {{-- ここにチェックマークが入る --}}
                    </div>
                    @endif
                    <img src="{{ asset('storage/'.$photo->photo_path) }}" class="object-cover cursor-pointer">
                </div>
                
                <div class="modal_pop hidden w-screen h-screen position-fixed top-0 left-0 z-20">
                    <div class="bg js-modal-close bg-slate-500 w-full h-full position-fixed z-30"></div>
                    <div class="modal_pop_main">
                        <img src="{{ asset('storage/'.$photo->photo_path) }}" class="js-modal-close-img object-contain popup-image position-absolute h-0 w-5/6 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-40">
                    </div>
                </div>
                @endforeach
                @else
                <div class="flex w-full h-full justify-center">
                    <p class="text-xl">写真がアップロードされておりません。</p>
                    <p class="text-xl">準備が整うまで今しばらくお待ちください。</p>
                </div>
                @endif
                
            </div>
            
        </div>
        @if (Auth::User()->user_categories_id === 1)
        <div id="btn-wrapper" class="w-full flex justify-end mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button type="button" id="delete-btn" class="btn btn-active btn-ghos mr-2 hidden">削除</button>
            <button type="button" class="btn btn-outline delete-mode-toggle-btn">削除機能を使う</button>
        </div>
        @endif
        <div class="w-full justify-center">
            {{ $photos->links() }}
        </div>
        
    </div>
    <script type="text/javascript" src="{{ mix('js/popupImage.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/deletePhotosInAlbumPage.js') }}"></script>
</x-app-layout>