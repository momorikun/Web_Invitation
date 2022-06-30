<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="grid grid-cols-2 gap-2 md:grid-cols-3 w-full justify-center">
                @foreach ($photos as $photo)
                <div class="w-full show_pop relative">
                    @if (Auth::User()->user_categories_id === 1)
                    <div class="text-red-500 font-weight-bold w-4 h-4 top-0 left-0 bg-white border-2 position-absolute delete_target cursor-pointer z-50">
                        {{-- ここにチェックマークが入る --}}
                    </div>
                    @endif
                    <img src="{{ asset('storage/'.$photo->photo_path) }}" class="object-cover cursor-pointer">
                </div>
                
                <div class="modal_pop hidden w-screen h-screen position-fixed top-0 left-0 z-20">
                    <div class="bg js-modal-close bg-slate-500 w-full h-full position-fixed z-30"></div>
                    <div class="modal_pop_main">
                        <img src="{{ asset('storage/'.$photo->photo_path) }}" class="js-modal-close-img object-contain xl:object-cover popup-image position-absolute h-0 w-5/6 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-40">
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
        @if (Auth::User()->user_categories_id === 1)
        <div class="w-full flex justify-end mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button type="button" class="btn btn-outline delete-mode-toggle-btn">削除機能を使う</button>
            {{-- <button type="button" class="btn btn-active btn-ghos ">削除</button> --}}
        </div>
        @endif
        <div class="w-full justify-center">
            {{ $photos->links() }}
        </div>
        
    </div>
    <script type="text/javascript" src="{{ mix('js/deletePhotosInAlbumPage.js') }}"></script>
</x-app-layout>


