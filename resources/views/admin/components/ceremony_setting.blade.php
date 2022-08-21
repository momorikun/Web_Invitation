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
            </div>

            @if ($ceremony_info != null)
            <h3 class="w-full text-lg mt-4">現在設定</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
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