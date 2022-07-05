@section('title', '| 回答一覧')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">
                @if ($items)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5" id="planToAttendedUserSection">
                    <h2 class="border-b border-grey-400 text-center">回答一覧</h2>
                    
                    <div class="mt-5 grid grid-cols-2 grid-rows-3 gap-2 md:grid-cols-3 w-full justify-center">
                        @php
                            $questionList = [];
                            for($i = 0; $i < count($items); ++$i){
                                if(in_array($items[$i]->question_body, $questionList)) continue;
                                $questionList[] = $items[$i]->question_body;
                            }
                        @endphp

                        @foreach ($questionList as $question)
                        <div class="border-b-2">
                            <h3 class="mt-5 underline text-center">Q:{{ $question }}</h3>
                            A:
                            @foreach ($items as $item)
                            @if ($item->question_body === $question)
                                <p class="my-1 max-w-full">・{{ $item->answer_body }}</p>
                            @endif
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    
                </div>
                @else
                <div class="flex w-full h-full justify-center">
                    <p class="text-xl">回答がアップロードされておりません。</p>
                </div>
                @endif
                
            </div>
            
        </div>
    </div>
    
</x-app-layout>