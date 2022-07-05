@section('title', '| 座席表')
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <section id="top" class="w-screen h-screen bg-cover bg-center pt-auto pb-auto" style="background-image: url('/image/topsecstion_bg.jpg')" >
        <div class="md:flex w-full justify-center h-full">
            <div class="w-full flex justify-center items-center sm:max-w-md my-16 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                @if ($seating_chart)       
                <div class="flex w-full justify-center">
                    <img src="{{ asset('storage/'.$seating_chart->photo_path) }}" alt="座席表は主催者までご確認ください" class="object-cover show_pop cursor-pointer">
                    <div class="modal_pop hidden w-screen h-screen position-fixed top-0 left-0 z-30">
                        <div class="bg js-modal-close bg-slate-500 w-full h-full position-fixed z-40"></div>
                        <div class="modal_pop_main">
                            <img src="{{ asset('storage/'.$seating_chart->photo_path) }}" alt="座席表は主催者までご確認ください" class="object-cover popup-image position-absolute h-5/6  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-50">
                        </div>
                    </div>
                </div>    
                
                @else
                <div>
                    <p class="text-center">ただいま準備中です。</p>
                    <br>
                    <p class="text-center">主催者が投稿するまで</p>
                    <p class="text-center">今しばらくお待ちください。</p>
                </div>
                @endif   
    </section>
    <script type="text/javascript" src="{{ mix('js/popupImage.js') }}"></script>
</x-app-layout>