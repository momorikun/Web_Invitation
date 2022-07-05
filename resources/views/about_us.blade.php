@section('title', '| 私たち')
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <section id="top" class="w-screen h-screen bg-cover bg-center pt-auto pb-auto" style="background-image: url('/image/topsecstion_bg.jpg')" >
        
        <div class="md:flex w-full justify-center h-full">
            @if ($ceremony_info)
            <div class="w-full sm:max-w-md my-16 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div>
                    <label class="block font-medium text-sm text-center text-gray-700" for="attendance">{{ optional($ceremony_info)->groom_name }} 様のご回答</label>
                    <div class="w-full mt-5">
                        <div class="w-full block md:flex justify-between">
                            <p class="w-full md:w-1/2">お相手の第一印象は？</p>
                            <p class="w-full md:w-1/2">{{ optional($groom_answer[0])->answer_body }}</p>
                        </div>
                        <div class="w-full block md:flex justify-between mt-2">
                            <p class="w-full md:w-1/2">お相手の現在の印象は？</p>
                            <p class="w-full md:w-1/2">{{ optional($groom_answer[1])->answer_body }}</p>
                        </div>
                        <div class="w-full block md:flex justify-between mt-2">
                            <p class="w-full md:w-1/2">1番の思い出は？</p>
                            <p class="w-full md:w-1/2">{{ optional($groom_answer[2])->answer_body }}</p>
                        </div>
                        <div class="w-full block justify-between mt-2">
                            <p class="w-full">馴れ初めなど</p>
                            <p class="w-full break-words whitespace-pre-wrap">{!! nl2br(optional($groom_answer[3])->answer_body) !!}</p>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="w-full sm:max-w-md my-16 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg md:ml-2">
                <div class="">
                    <label class="block font-medium text-sm text-center text-gray-700" for="attendance">{{ optional($ceremony_info)->bride_name }} 様のご回答</label>
                    <div class="w-full mt-5">
                        <div class="w-full block md:flex justify-between">
                            <p class="w-full md:w-1/2">お相手の第一印象は？</p>
                            <p class="w-full md:w-1/2">{{ optional($bride_answer[0])->answer_body }}</p>
                        </div>
                        <div class="w-full block md:flex justify-between mt-2">
                            <p class="w-full md:w-1/2">お相手の現在の印象は？</p>
                            <p class="w-full md:w-1/2">{{ optional($bride_answer[1])->answer_body }}</p>
                        </div>
                        <div class="w-full block md:flex justify-between mt-2">
                            <p class="w-full md:w-1/2">1番の思い出は？</p>
                            <p class="w-full md:w-1/2">{{ optional($bride_answer[2])->answer_body }}</p>
                        </div>
                        <div class="w-full block justify-between mt-2">
                            <p class="w-full md:w-1/2">馴れ初めなど</p>
                            <p class="w-full md:w-1/2 break-words whitespace-pre-wrap overscroll-auto">{!! nl2br(optional($bride_answer[3])->answer_body) !!}</p>
                        </div>
                    </div>    
                </div>
            </div>
            @else
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
            @endif
        </div>    
    </section>
</x-app-layout>