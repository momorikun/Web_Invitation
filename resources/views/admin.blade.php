@section('title', '| 主催者')
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
                    <x-auth-validation-errors class="mb-4" :errors="$errors->guestInfoUpdate" />
                    <form id="guestSearch">
                        <label for="guestSearchInputKana" class="label">
                            <span class="label-text">ゲスト名</span>
                        </label>
                        <input type="text" id="guestSearchInputKana" name="guestSearchInputKana" class="input input-bordered dark:bg-white" placeholder="フリガナ">
                        <input type="hidden" id="guestSearchCeremonyId" value="{{ Auth::User()->ceremonies_id }}">
                        <button type="button" id="guestSearchButton" class="btn btn-active btn-ghos">ゲスト検索</button>
                    </form>
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
                <div id="invitation" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
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
                <div id="seating-chart" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">座席表アップロード</h2>
                    @if(session()->has('message'))
                        <div class="mt-3 list-disc list-inside text-sm text-red-600">
                            {{session('message')}}
                        </div>
                    @endif
                    @if (count($errors->storeSeatingChartImg) > 0)
                            <div>           
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->storeSeatingChartImg->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form method="POST" action="{{ route('upload_seating_chart') }}" enctype="multipart/form-data" class=" w-full">
                        @csrf
                            <input type="file" name="file" class="mt-5">
                            <input type="hidden" name="upload_user_email" value="{{ Auth::User()->email }}">
                        <div class="p-6 bg-white flex justify-center w-full">
                            <button type="submit" class="btn btn-active btn-ghos">画像アップロード</button>
                        </div>
                    </form>
                    @if ($seating_img)
                    
                    <div class="flex w-full justify-center">
                        <img src="{{ asset('storage/'.$seating_img->photo_path) }}" alt="座席表は主催者までご確認ください" class="object-cover show_pop cursor-pointer">
                        <div class="modal_pop hidden w-screen h-screen position-fixed top-0 left-0 z-30">
                            <div class="bg js-modal-close bg-slate-500 w-full h-full position-fixed z-40"></div>
                            <div class="modal_pop_main">
                                <img src="{{ asset('storage/'.$seating_img->photo_path) }}" alt="座席表は主催者までご確認ください" class="object-cover popup-image position-absolute h-5/6  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-50">
                            </div>
                        </div>
                    </div>    
                    <div class="w-full flex justify-end mt-5">
                        <form action="{{ route('delete_seating_chart') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $seating_img->upload_user_ceremony_id }}" name="upload_user_ceremony_id">
                        <button type="submit" class="btn btn-active btn-ghos">画像を削除</button>
                        </form>
                    </div>
                    @endif
                    
                </div>

                {{-- 挙式についての設定セクション --}}
                <div id="ceremony-info" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">挙式についての詳細設定</h2>
                    <div class="p-0 mt-4 bg-white">
                        @if (count($errors->uploadWeddingInfo) > 0)
                            <div>           
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->uploadWeddingInfo->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($ceremony_info)
                        <input type="hidden" id="venue_address" value="{{ $ceremony_info->address }}">
                        @else
                        <input type="hidden" id="venue_address" value="">
                        @endif
                        
                        <form method="POST" action="{{ route('upload_wedding_info') }}" class="block w-full">
                            @csrf
                            <h3 class="w-full text-lg">お名前</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
                                <div class="form_control w-full max-w-xs px-1">
                                    <label for="groom_name" class="label">
                                        <span class="label-text">新郎 お名前</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white w-full" id="groom_name" name="groom_name" value="{{ old('groom_name') }}">
                                </div>
                                <div class="form_control w-full max-w-xs px-1">
                                    <label for="bride_name" class="label">
                                        <span class="label-text">新婦 お名前</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white w-full" id="bride_name" name="bride_name" value="{{ old('bride_name') }}">
                                </div>
                            </div>

                            <h3 class="w-full text-lg mt-4">開催日</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
                                <div class="form-control w-full max-w-xs">
                                    <label for="ceremonies_dates_year" class="label">
                                        <span class="label-text">年</span>
                                    </label>
                                    <select class="select select-bordered dark:bg-white" id="ceremonies_dates_year" name="ceremonies_dates_year" value="{{ old('ceremonies_dates_year') }}">
                                        {{-- date_selectbox.jsにて管理 --}}
                                    </select>    
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="ceremonies_dates_month" class="label">
                                        <span class="label-text">月</span>
                                    </label>
                                    <select class="select select-bordered dark:bg-white" id="ceremonies_dates_month" name="ceremonies_dates_month" value="{{ old('ceremonies_dates_month') }}">
                                        {{-- date_selectbox.jsにて管理 --}}
                                    </select>
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label for="ceremonies_dates_day" class="label">
                                        <span class="label-text">日</span>
                                    </label>
                                    <select class="select select-bordered dark:bg-white" id="ceremonies_dates_day" name="ceremonies_dates_day" value="{{ old('ceremonies_dates_day') }}">
                                        {{-- date_selectbox.jsにて管理 --}}
                                    </select>
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="attendance_contact_limit_day" class="label">
                                        <span class="label-text">出欠連絡 締切日</span>
                                    </label>
                                    <input type="date" class="select select-bordered dark:bg-white" id="attendance_contact_limit_day" name="attendance_contact_limit_day" value="{{ old('attendance_contact_limit_day') }}">
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="ceremonies_reception_time" class="label">
                                        <span class="label-text">受付時間</span>
                                    </label>
                                    <input type="time" class="select select-bordered dark:bg-white" id="ceremonies_reception_time" name="ceremonies_reception_time" value="{{ old('ceremonies_reception_time') }}">
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="start_ceremonies_time" class="label">
                                        <span class="label-text">結婚式 開始時間</span>
                                    </label>
                                    <input type="time" class="select select-bordered dark:bg-white" id="start_ceremonies_time" name="start_ceremonies_time" value="{{ old('start_ceremonies_time') }}">
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="start_wedding_reception_time" class="label">
                                        <span class="label-text">披露宴 開始時間</span>
                                    </label>
                                    <input type="time" class="select select-bordered dark:bg-white" id="start_wedding_reception_time" name="start_wedding_reception_time" value="{{ old('start_wedding_reception_time') }}">
                                </div>
                                
                            </div>
                            
                            <h3 class="w-full text-lg mt-4">会場</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
                                {{-- //TODO:Yahoo!ローカルサーチAPIの登録、住所からジオコーディング、無理なら地図なし --}}
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_state" class="label">
                                        <span class="label-text">都道府県</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_state" name="place_state" value="{{ old('place_state') }}">
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label for="place_city" class="label">
                                        <span class="label-text">市区町村</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_city" name="place_city" value="{{ old('place_city') }}">
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_address_line" class="label">
                                        <span class="label-text">番地・号</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_address_line" name="place_address_line" value="{{ old('place_address_line') }}">
                                </div>                                
                                <div class="form-control w-full max-w-xs">
                                    <label for="place_name" class="label">
                                        <span class="label-text">会場名</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_name" name="place_name" old="{{ old('place_name') }}">
                                </div>
                            </div>
                            <div class="w-full flex justify-end mt-5">
                                <button type="submit" class="btn btn-active btn-ghos">アップロード</button>
                                {{-- <a href="/delete_photo" class="btn btn-active btn-ghos ml-1">編集</a> --}}
                            </div>

                            @if ($ceremony_info != null)
                            <h3 class="w-full text-lg mt-4">現在設定</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
                                {{-- //TODO:Yahoo!ローカルサーチAPIの登録、住所からジオコーディング、無理なら地図なし --}}
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_name" class="label">
                                        <span class="label-text">日付</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="day" name="day" placeholder="日付" value="{{ $ceremony_info->wedding_date }}"  disabled>
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_name" class="label">
                                        <span class="label-text">受付開始時間</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="start_reception" name="start_reception" placeholder="受付開始時間" value="{{ $ceremony_info->reception_time }}"  disabled>
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_name" class="label">
                                        <span class="label-text">結婚式 開始時間</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="start_ceremony" name="start_ceremony" placeholder="結婚式 開始時間" value="{{ $ceremony_info->start_ceremony_time }}"  disabled>
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_name" class="label">
                                        <span class="label-text">披露宴 開始時間</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="start_wedding_reception" name="start_wedding_reception" placeholder="披露宴 開始時間" value="{{ $ceremony_info->start_wedding_reception_time }}"  disabled>
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_state" class="label">
                                        <span class="label-text">住所</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_state" name="place_state" placeholder="都道府県" value="{{ $ceremony_info->address }}" disabled>
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_name" class="label">
                                        <span class="label-text">会場</span>
                                    </label>
                                    <input type="text" class="input input-bordered dark:bg-white" id="place_name" name="place_name" placeholder="会場名" value="{{ $ceremony_info->place_name }}"  disabled>
                                </div>                             
                            </div>
                            @endif
                            <div class="flex w-full justify-center">
                                @if ($ceremony_info)
                                <div id="map" class="w-full md:w-1/2 h-96 mt-16 bg-slate-500">
                                    
                                </div>                                
                                @endif
                                
                            </div>
                            
                        </form>
                    </div>
                </div>

                {{-- アルバム掲示セクション --}}
                <div id="album" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">アルバム掲示</h2>
                    <div class="p-0 mt-4 bg-white">
                        @if (count($errors->uploadPhoto) > 0)
                            <div>   
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->uploadPhoto->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- post先はname指定。resourceで自動生成される。php artisan route:listで確認 --}}
                        <form method="POST" action="{{ route('upload_photo') }}" enctype="multipart/form-data" class="block">
                            @csrf
                            <input type="file" name="files[][photo]" multiple>
                            <input type="hidden" name="upload_user_id" value="{{ Auth::User()->id }}">
                            <div class="p-6 bg-white flex justify-center w-full">
                                <button type="submit" class="btn btn-active btn-ghos mr-1">アップロード</button>
                                <a href="{{ route('album_page') }}" class="btn btn-outline ml-1">写真一覧へ</a>
                                {{-- <a href="/delete_photo" class="btn btn-active btn-ghos ml-1">編集</a> --}}
                            </div>
                        </form>
                        {{-- //TODO:画像アップロードがなければないことを表す文を表示 --}}
                        {{-- //TODO:colorboxの適応（imgタグをaタグで囲む） --}}
                        
                    </div>
                </div>

                {{-- ふたりへの質問のセクション --}}
                <div id="questions" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">ふたりへの質問</h2>
                    <p class="text-gray-400">※この回答は来客へ開示されます</p>
                    <p class="text-gray-400">※一度回答頂いている場合、回答内容が更新されます</p>
                    <div class="grid grid-cols-2 mt-5">
                        {{-- //TODO:新郎Q&A Controller --}}
                        <form action="{{ route('Q_and_A_for_Groom') }}" method="POST" class="w-full ">
                            @csrf
                            <div class="w-full py-2 pr-2 border-r-2">
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

                        {{-- //TODO:新婦Q&A Controller --}}
                        <form action="{{ route('Q_and_A_for_Bride') }}" method="POST">
                            @csrf
                            <div class="w-full py-2 pl-5">
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
@if (optional($ceremony_info)->address)
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MIX_GOOGLE_MAPS_API_KEY') }}"></script>
<script type="text/javascript" src="{{ mix('js/googleMapsApi.js') }}"></script>    
@endif
<script type="text/javascript" src="{{ mix('js/popupImage.js') }}"></script>


