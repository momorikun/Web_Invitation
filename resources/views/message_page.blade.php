@section('title', '| メッセージ一覧')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">メッセージ一覧</h2>
                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3 w-full justify-center">
                        @foreach ($messages as $message)
                        <div class="mt-5 border rounded-md p-10">
                            <p class="text-center">{{ $message->upload_user_name }} 様</p>
                            <br>
                            <p class="text-center">本文：<br>{!! nl2br($message->message_body) !!}</p>
                        </div>
                        @endforeach   
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>