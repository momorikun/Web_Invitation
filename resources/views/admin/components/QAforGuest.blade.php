{{-- 逆Q&Aセクション --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
    <h2 class="border-b border-grey-400">来客への質問</h2>
    <p class="text-gray-400">おすすめの旅行先やお店など、ゲストの方に質問してみましょう</p>

    <form id="questionForm" action="{{ route('QuestionForGuest') }}" method="POST">
        @csrf
        <div id="QuestionforGuest" class="w-full">
            <div>
                <label class="w-full">
                    <span class="label-text">Question 1</span>
                </label>
                <input type="text" name="Q1forGuest" id="Q1forGuest" class="input input-bordered w-full dark:bg-white">
            </div>
        </div>
        {{-- 追加はaddQuestions.jsにて管理 --}}
        <div class="flex justify-end mt-5">
            <button type="button" id="addQuestion" class="btn btn-active btn-ghos text-lg">+</button>
        </div>
        <div class="flex justify-end mt-5">
            <button id="uploadQuestionButton" type="submit" class="btn btn-active btn-ghos">アップロード</button>
        </div>
    </form>

    <div class="block w-full mt-5">
        @if (count($errors->delete_question) > 0)
            <div>           
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->delete_question->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @foreach ($questions as $question)
        <div class="flex w-full justify-between mt-2">
            <p>{{ $question->question_body }}</p>
            <form action="{{ route('delete_question') }}" method="POST">
                @csrf
                <input type="hidden" name="delete_target_id" value="{{ $question->id }}">
                <input type="hidden" name="delete_target_body" value="{{ $question->question_body }}">
                <div>
                    <button type="submit" class="btn btn-active btn-ghos w-16 ml-2">削除</button>
                </div>
                
            </form>
        </div>
        @endforeach
        <div class="w-full flex justify-center my-5">
            <a href="{{ route('answers') }}" class="btn btn-outline">皆さんからの回答を見る</a>
        </div>
    </div>
    <div class="w-full justify-center">
        {{ $questions->links() }}
    </div>
</div>