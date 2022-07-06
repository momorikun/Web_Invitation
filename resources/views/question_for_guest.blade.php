@section('title', '| 質問一覧')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">
                
                @if ($questions)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <h2 class="border-b border-grey-400 text-center">質問一覧</h2>
                    @if(session()->has('alert'))
                        <p class="text-center underline text-red-400">
                            {{session('alert')}}
                        </p>
                    @endif
                    @if (count($errors->answer_questions) > 0)
                        <div>           
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->answer_questions->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 grid-rows-3 gap-2 md:grid-cols-3 w-full justify-center">
                        @foreach ($questions as $question)
                        <form action="{{ route('answer_questions') }}" method="POST" class="mt-5 border border-slate-300 rounded-md p-2">
                            @csrf
                            <label for="answer_body" class="label">{{ $question->question_body }}</label>
                            <input type="text" name="answer_body" class="input input-bordered dark:bg-white w-full">
                            <input type="hidden" name="id" value="{{ $question->id }}">
                            <div class="w-full justify-center flex">
                                <button type="submit" class="btn btn-active btn-ghos mt-2">回答する</button>
                            </div>
                        </form>
                        @endforeach    
                    </div>
                    <div class="w-full justify-center">
                        {{ $questions->links() }}
                    </div>
                </div>
                @else
                <div class="flex w-full h-full justify-center">
                    <p class="text-xl">質問がアップロードされておりません。</p>
                    <p class="text-xl">準備が整うまで今しばらくお待ちください。</p>
                </div>
                @endif
                
            </div>
            
        </div>
    </div>
    
</x-app-layout>