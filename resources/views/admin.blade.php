<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">

                {{-- 出席者一覧のセクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5" id="planToAttendedUserSection">
                    <h2 class="border-b border-grey-400">出席者一覧</h2>
                    <div class="p-6 bg-white flex justify-center">
                        <a href="/admin/attend_pdf" class="btn btn-active btn-ghos">出席者一覧を表示する</a>
                    </div>
                    <noscript>
                        <p class="text-red-500 underline">JavaScriptを有効にしてからご利用くださいませ。</p>
                    </noscript>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form id="guestSearch">
                        <label for="guestSearchInputKana" class="label">
                            <span class="label-text">ゲスト名</span>
                        </label>
                        <input type="text" id="guestSearchInputKana" name="guestSearchInputKana" class="input input-bordered dark:bg-white" placeholder="フリガナ">
                        <input type="hidden" id="guestSearchCeremonyId" value="{{ Auth::User()->ceremonies_id }}">
                        <button type="button" id="guestSearchButton" class="btn btn-active btn-ghos">ゲスト検索</button>
                    </form>
                    
                        {{-- //TODO: DBから引っ張ったゲスト情報を表示するフォームを作る --}}
                        {{-- //TODO: 名前・カナ・メールアドレス・ご祝儀金額・備考欄 --}}
                        
                    
                </div>

                {{-- QRコード読み取りのセクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">出席確認</h2>
                    <noscript>
                        <p class="text-red-500 underline">JavaScriptを有効にしてからご利用くださいませ。</p>
                    </noscript>
                    <div class="p-6 bg-white flex justify-center">
                        <a href="{{ route('qr_code_reader_mode') }}" class="btn btn-active btn-ghos">QRコードを読み取る</a>
                    </div>
                </div>

                {{-- 招待状送付のセクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">招待状送付</h2>
                    <p class="text-gray-400">※PC版LINEでは動作しません。</p>
                    <p class="text-gray-400">送付はスマートフォンから行ってください。 </p>
                    <p class="text-gray-400">記載いただいた文の最後に結婚式IDが追加されます。</p>
                    <form action="{{ route('url_encode') }}" method="POST" class="" target="_blank" rel="noopener noreferrer">
                        @csrf
                        <label for="text" class="label">
                            <span class="label-text">招待文</span>
                        </label>
                        <textarea name="text" id="text" class="textarea textarea-bordered dark:bg-white w-full" cols="30" rows="10">{{ old('text') }}</textarea>
                        <input type="hidden" name="send_ceremony_id" value="{{ Auth::User()->ceremonies_id }}">
                        <div class="p-6 bg-white flex justify-center">
                            <button type="submit" class="btn btn-active btn-ghos">招待状を送付する</button>
                        </div>
                    </form>
                </div>

                {{-- 座席アップロードセクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">座席表アップロード</h2>
                    <form method="POST" action="#" enctype="multipart/form-data" class=" w-full">
                        @csrf
                            <input type="file" name="file" class="mt-5">
                            <input type="hidden" name="upload_user_id" value="{{ Auth::User()->id }}">
                        <div class="p-6 bg-white flex justify-center w-full">
                            <button type="submit" class="btn btn-active btn-ghos">画像アップロード</button>
                        </div>
                    </form>
                </div>

                {{-- 挙式についての設定セクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">挙式についての詳細設定</h2>
                    <div class="p-0 mt-4 bg-white">
                        @if (count($errors) > 0)
                            <div>           
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('upload_wedding_info') }}" class="block w-full">
                            @csrf
                            <h3 class="w-full text-lg">開催日</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
                                <div class="form-control w-full max-w-xs">
                                    <label for="ceremonies_dates_year" class="label">
                                        <span class="label-text">year</span>
                                    </label>
                                    <select class="select select-bordered dark:bg-white" id="ceremonies_dates_year" name="ceremonies_dates_year">
                                        <noscript>
                                        @for ($birth_year = idate('Y'); $birth_year <= idate('Y')+10; ++$birth_year){
                                            <option value="{{ $birth_year }}">{{ $birth_year }}</option>
                                        } 
                                        @endfor
                                        </noscript>
                                    </select>    
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="ceremonies_dates_month" class="label">
                                        <span class="label-text">month</span>
                                    </label>
                                    <select class="select select-bordered dark:bg-white" id="ceremonies_dates_month" name="ceremonies_dates_month">
                                        <noscript>
                                        @for ($birth_month = 1; $birth_month <= 12; ++$birth_month){
                                            <option value="{{ $birth_month }}">{{ $birth_month }}</option>
                                        }   
                                        @endfor
                                        </noscript>
                                    </select>
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label for="ceremonies_dates_day" class="label">
                                        <span class="label-text">day</span>
                                    </label>
                                    <select class="select select-bordered dark:bg-white" id="ceremonies_dates_day" name="ceremonies_dates_day">
                                        <noscript>
                                        @for ($birth_day = 1; $birth_day <= 31; ++$birth_day){
                                                <option value="{{ $birth_day }}">{{ $birth_day }}</option>
                                        }   
                                        @endfor
                                        </noscript>
                                    </select>
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="ceremonies_dates_time" class="label">
                                        <span class="label-text">time</span>
                                    </label>
                                    <input type="time" class="select select-bordered dark:bg-white" id="ceremonies_dates_time" name="ceremonies_dates_time">
                                </div>
                            </div>
                            
                            <h3 class="w-full text-lg mt-4">会場</h3>
                            <div class="grid grid-cols-2 w-full justify-center mx-auto">
                                {{-- //TODO: 会場の住所カラムを追加する --}}
                                {{-- //TODO:Yahoo!ローカルサーチAPIの登録、住所からジオコーディング、無理なら地図なし --}}
                                <div class="form-control w-full max-w-xs">
                                    <label for="place_name" class="label">
                                        <span class="label-text">chapel / venue name</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_name" name="place_name" placeholder="会場名">
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_address" class="label">
                                        <span class="label-text">Address</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_address" name="place_address" placeholder="住所">
                                </div>
                            </div>                            
                            {{-- //TODO: 当日のタイムスケジュール掲載機能 --}}
                            <input type="hidden" name="upload_user_id" value="{{ Auth::User()->id }}">
                            <div class="w-full flex justify-end mt-5">
                                <button type="submit" class="btn btn-active btn-ghos">アップロード</button>
                                {{-- <a href="/delete_photo" class="btn btn-active btn-ghos ml-1">編集</a> --}}
                            </div>
                            
                        </form>
                    </div>
                </div>

                {{-- アルバム掲示セクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">アルバム掲示</h2>
                    <div class="p-0 mt-4 bg-white">
                        @if (count($errors) > 0)
                            <div>   
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- post先はname指定。resourceで自動生成される。php artisan route:listで確認 --}}
                        <form method="POST" action="{{ route('upload_photo') }}" enctype="multipart/form-data" class="xl:flex">
                            @csrf
                            <input type="file" name="files[][photo]" multiple>
                            <input type="hidden" name="upload_user_id" value="{{ Auth::User()->id }}">
                            <div class="w-full flex justify-end mt-5">
                                <button type="submit" class="btn btn-active btn-ghos">アップロード</button>
                                {{-- <a href="/delete_photo" class="btn btn-active btn-ghos ml-1">編集</a> --}}
                            </div>
                        </form>
                        {{-- //TODO:画像表示(3列*n行) 画像にRemoveのリンク --}}
                        {{-- //TODO:画像アップロードがなければないことを表す文を表示 --}}
                    </div>
                </div>

                {{-- ふたりへの質問のセクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">ふたりへの質問</h2>
                    <p class="text-gray-400">※この回答は来客へ開示されます</p>
                    <div class="grid grid-cols-2 mt-5">
                        {{-- //TODO:新郎Q&A Controller --}}
                        <form action="#" method="POST" class="w-full ">
                            @csrf
                            <div class="w-full py-2 pr-2 border-r-2">
                                <p class="text-gray-400">新郎様</p>
                                <div class="mb-2">
                                    <label for="Q1forGroom" class="w-full">
                                        <span class="label-text">新婦様の第一印象は？</span>
                                    </label>
                                    <input type="text" name="Q1forGroom" id="Q1forGroom" class="input input-bordered w-full dark:bg-white">
                                </div>
                                <div class="mb-2">
                                    <label for="Q2forGroom" class="w-full">
                                        <span class="label-text">新婦様の第一印象は？</span>
                                    </label>
                                    <input type="text" name="Q2forGroom" id="Q2forGroom" class="input input-bordered w-full dark:bg-white">
                                </div>
                                <div class="mb-2">
                                    <label for="Q3forGroom w-full">
                                        <span class="label-text">1番の思い出は？</span>
                                    </label>
                                    <input type="text" name="Q3forGroom" id="Q3forGroom" class="input input-bordered w-full dark:bg-white">
                                </div>
                                <div class="mb-2">
                                    <label for="Q4forGroom w-full">
                                        <span class="label-text">結婚を祝ってくださる方へのメッセージを！</span>
                                    </label>
                                    <textarea name="Q4forGroom" id="Q4forGroom" cols="30" rows="10" class="textarea textarea-bordered w-full mt-2 dark:bg-white"></textarea>
                                </div>
                                <div class="flex w-full justify-end">
                                    <button type="submit" class="btn btn-active btn-ghos ">アップロード</button>
                                </div>
                            </div>
                        </form>

                        {{-- //TODO:新婦Q&A Controller --}}
                        <form action="#" method="POST">
                            <div class="w-full py-2 pl-5">
                                <p class="text-gray-400">新婦様</p>
                                <div class="mb-2">
                                    <label for="Q1forBride w-full">
                                        <span class="label-text">新郎様の第一印象は？</span>
                                    </label>
                                    <input type="text" name="Q1forBride" id="Q1forBride" class="input input-bordered w-full dark:bg-white">
                                </div>
                                <div class="mb-2">
                                    <label for="Q2forBride w-full">
                                        <span class="label-text">新郎様の現在の印象は？</span>
                                    </label>
                                    <input type="text" name="Q2forBride" id="Q2forBride" class="input input-bordered w-full dark:bg-white">
                                </div>
                                <div class="mb-2">
                                    <label for="Q3forBride w-full">
                                        <span class="label-text">1番の思い出は？</span>
                                    </label>
                                    <input type="text" name="Q3forBride" id="Q3forBride" class="input input-bordered w-full dark:bg-white">
                                </div>
                                <div class="mb-2">
                                    <label for="Q4forBride w-full">
                                        <span class="label-text">結婚を祝ってくださる方へのメッセージを！</span>
                                    </label>
                                    <textarea name="Q4forBride" id="Q4forBride" cols="30" rows="10" class="textarea textarea-bordered w-full mt-2 dark:bg-white"></textarea>
                                </div>
                                <div class="flex w-full justify-end">
                                    <button type="submit" class="btn btn-active btn-ghos ">アップロード</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>

                {{-- 逆Q&Aセクション --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">来客への質問</h2>
                    <p class="text-gray-400">おすすめの旅行先やお店など、ゲストの方に質問してみましょう</p>

                    <form id="questionForm">
                        @csrf
                        <input type="hidden" name="upload_user_email" value="{{ Auth::User()->email }}">
                        <input type="hidden" name="upload_user_ceremony_id" value="{{ Auth::User()->ceremonies_id }}">
                        <div id="QuestionforGuest" class="w-full">
                            <div>
                                <label class="w-full">
                                    <span class="label-text">Question 1</span>
                                </label>
                                <input type="text" name="QforGuest" id="Q1forGuest" class="input input-bordered w-full dark:bg-white">
                            </div>
                        </div>
                        <div class="flex justify-end mt-5">
                            <button type="button" id="addQuestion" class="btn btn-active btn-ghos text-lg">+</button>
                        </div>
                        <div class="flex justify-end mt-5">
                            <button id="uploadQuestionButton" type="button" class="btn btn-active btn-ghos">アップロード</button>
                        </div>
                    </form>

                    <div>

                    </div>
                </div>
                <div class="flex w-full mt-5 justify-end pr-5">
                    <a href="#site-top" class="btn btn-active btn-ghos">TOPに戻る</a>
                </div>
                
            </div>
            
        </div>
    </div>
</x-app-layout>
<script type="text/javascript" src="{{ mix('js/date_selectbox.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/getUsersInformation.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/addQuestion.js') }}"></script>


