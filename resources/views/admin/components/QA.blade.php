{{-- ふたりへの質問のセクション --}}
<div id="questions" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
    <h2 class="border-b border-grey-400">ふたりへの質問</h2>
    <p class="text-gray-400">※この回答は来客へ開示されます</p>
    <p class="text-gray-400">※一度回答頂いている場合、回答内容が更新されます</p>
    <div class="block md:grid grid-cols-2 mt-5">
        <form action="{{ route('Q_and_A_for_Groom') }}" method="POST" class="w-full ">
            @csrf
            <div class="w-full py-2 md:pr-4 md:border-r-2">
                <p class="text-gray-400">新郎</p>
                <div class="mb-2">
                    <label for="Q1forGroom" class="w-full">
                        @if (optional($ceremony_info)->bride_name !== null)
                        <span class="label-text">{{ optional($ceremony_info)->bride_name }}様の第一印象は？</span>
                        @else
                        <span class="label-text">新婦の第一印象は？</span>
                        @endif
                    </label>
                    <input type="text" name="Q1forGroom" id="Q1forGroom" class="input input-bordered w-full dark:bg-white" value="{{ old('Q1forGroom') }}">
                </div>
                <div class="mb-2">
                    <label for="Q2forGroom" class="w-full">
                        @if (optional($ceremony_info)->bride_name !== null)
                        <span class="label-text">{{ optional($ceremony_info)->bride_name }}様の現在の印象は？</span>
                        @else
                        <span class="label-text">新婦の現在の印象は？</span>
                        @endif
                    </label>
                    <input type="text" name="Q2forGroom" id="Q2forGroom" class="input input-bordered w-full dark:bg-white" value="{{ old('Q2forGroom') }}">
                </div>
                <div class="mb-2">
                    <label for="Q3forGroom w-full">
                        <span class="label-text">1番の思い出は？</span>
                    </label>
                    <input type="text" name="Q3forGroom" id="Q3forGroom" class="input input-bordered w-full dark:bg-white" value="{{ old('Q3forGroom') }}">
                </div>
                <div class="mb-2">
                    <label for="Q4forGroom w-full">
                        <span class="label-text">馴れ初めなど</span>
                    </label>
                    <textarea name="Q4forGroom" id="Q4forGroom" cols="30" rows="10" class="textarea textarea-bordered w-full mt-2 dark:bg-white">{{ old('Q4forGroom') }}</textarea>
                </div>
                @if (count($groom_answers) === 0)
                <div class="flex w-full justify-end">
                    <button type="submit" class="btn btn-active btn-ghos ">アップロード</button>
                </div>    
                @else
                <div class="flex w-full justify-end">
                    <button type="submit" class="btn btn-active btn-ghos ">更新</button>
                </div>
                @endif
                
            </div>
        </form>
        <form action="{{ route('Q_and_A_for_Bride') }}" method="POST">
            @csrf
            <div class="w-full py-2 md:pl-4">
                <p class="text-gray-400">新婦</p>
                <div class="mb-2">
                    <label for="Q1forBride w-full">
                        @if (optional($ceremony_info)->groom_name !== null)
                        <span class="label-text">{{ optional($ceremony_info)->groom_name }}様の第一印象は？</span>
                        @else
                        <span class="label-text">新郎の第一印象は？</span>
                        @endif
                    </label>
                    <input type="text" name="Q1forBride" id="Q1forBride" class="input input-bordered w-full dark:bg-white" value="{{ old('Q1forBride') }}">
                </div>
                <div class="mb-2">
                    <label for="Q2forBride w-full">
                        @if (optional($ceremony_info)->groom_name !== null)
                        <span class="label-text">{{ optional($ceremony_info)->groom_name }}様の現在の印象は？</span>
                        @else
                        <span class="label-text">新郎の現在の印象は？</span>
                        @endif
                    </label>
                    <input type="text" name="Q2forBride" id="Q2forBride" class="input input-bordered w-full dark:bg-white" value="{{ old('Q2forBride') }}">
                </div>
                <div class="mb-2">
                    <label for="Q3forBride w-full">
                        <span class="label-text">1番の思い出は？</span>
                    </label>
                    <input type="text" name="Q3forBride" id="Q3forBride" class="input input-bordered w-full dark:bg-white" value="{{ old('Q3forBride') }}">
                </div>
                <div class="mb-2">
                    <label for="Q4forBride w-full">
                        <span class="label-text">馴れ初めなど</span>
                    </label>
                    <textarea name="Q4forBride" id="Q4forBride" cols="30" rows="10" class="textarea textarea-bordered w-full mt-2 dark:bg-white">{{ old('Q4forBride') }}</textarea>
                </div>
                @if (count($bride_answers) === 0)
                <div class="flex w-full justify-end">
                    <button type="submit" class="btn btn-active btn-ghos ">アップロード</button>
                </div>    
                @else
                <div class="flex w-full justify-end">
                    <button type="submit" class="btn btn-active btn-ghos ">更新</button>
                </div>
                @endif
                
            </div>
        </form>
    </div>
</div>
