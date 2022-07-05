@section('title', '| メッセージ確認')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <section id="top" class="w-screen h-screen bg-cover bg-center pt-auto pb-auto" style="background-image: url('/image/topsecstion_bg.jpg')" >
        <div class="md:flex w-full justify-center h-full">
            <div class="w-full sm:max-w-md my-auto px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg md:ml-2">
                <form action="{{ route('message_send') }}" method="GET">
                    @csrf
                    <div class="w-full h-full">
                        <label for="message_for_couple border-b-2 border-grey-400" class="text-lg">送信してもよろしいでしょうか？</label>
                        <div class="w-full h-full mt-5">
                            {!! nl2br($data['message_for_couple']) !!}
                            <textarea class="textarea textarea-bordered hidden dark:bg-white w-full" name="message_for_couple" id="" cols="30" rows="15">{!! nl2br($data['message_for_couple']) !!}</textarea>
                        </div>
                        <div class="w-full flex justify-center position-absolute bottom-1">
                            <button type="submit" class="btn btn-active btn-ghos">送信する</button>
                            <a href="{{ route('message_for_couple') }}" class="btn btn-outline ml-1">戻る</a>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>