@section('title', '| 準備中')
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <section id="top" class="w-screen h-screen bg-cover bg-center pt-auto pb-auto" style="background-image: url('/image/topsecstion_bg.jpg')" >
        
        <div class="md:flex w-full justify-center h-full">
            <div class="w-full flex justify-center items-center sm:max-w-md my-16 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div>
                    <p class="text-center">ただいま準備中です。</p>
                    <br>
                    <p class="text-center">主催者が投稿するまで</p>
                    <p class="text-center">今しばらくお待ちください。</p>
                </div>
            </div>
        </div>    
    </section>
</x-app-layout>