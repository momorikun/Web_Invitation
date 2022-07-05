@section('title', '| ゲスト')
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <section id="top" class="w-screen h-screen bg-cover bg-center pt-auto pb-auto" style="background-image: url('/image/topsecstion_bg.jpg')" >
        <div class="flex w-full justify-center h-full">
            <div class="w-full sm:max-w-md my-auto px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form id="confimartion_for_attendance" method="POST" action="{{ route('answer_for_attendance') }}">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-center text-gray-700" for="attendance">ご出席連絡</label>
                        @if (count($errors->answer_for_attendance) > 0)
                            <div>           
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->answer_for_attendance->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="w-full mt-5 flex justify-center">
                            <input class="mt-1" type="radio" id="attendance_yes" name="attendance" value="1" checked>御出席
                            <input class="mt-1 ml-10" type="radio" id="attendance_no" name="attendance" value="0">御欠席
                        </div>
                        <div class="w-full mt-5 justify-center">
                            @if ($ceremony_info)
                            <p class="text-center">
                                誠に勝手ながら
                                <br>
                                <u>{{ optional($ceremony_info)->attendance_contact_limit_day }}</u>
                                <br>
                                迄にご返信いただければ幸いに存じます
                            </p>    
                            @endif
                            
                            @if (Auth::User()->is_answered === 1)
                                @if (Auth::User()->plan_to_attend === 1)
                                <p class="text-sm text-red-400 text-center">現在の回答内容：ご出席予定</p>        
                                @else
                                <p class="text-sm text-red-400 text-center">現在の回答内容：ご欠席予定</p>        
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">登録</button>
                    </div>
                </form>
            </div>
            <div class="modal_confirm hidden w-screen h-screen position-fixed top-0 left-0 z-30">
                <div class="bg position-absolute h-5/6  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-50">
                    <div class="modal_confirm_form rounded-md w-11/12 md:w-3/4 p-4 md:p-10">
                        <p class="text-center text-xl">謹啓</p>
                        <br>
                        <p  class="text-center">皆様には益々ご清祥のこととお慶び申し上げます</p>
                        <br>
                        <p  class="text-center">このたび私たちは結婚式を挙げることになりました</p>
                        <br>
                        <p  class="text-center">つきましては日ごろお世話になっている<br>皆様にお集まりいただき</p>
                        <p  class="text-center">ささやかな披露宴を催したいと存じます</p>
                        <br>
                        <p  class="text-center">ご多用中 誠に恐縮ではございますが</p>
                        <p  class="text-center">ご来臨の栄を賜りたく謹んでご案内申し上げます</p>
                        <br>
                        <p class="w-full text-right">敬白</p>
                        <br>
                        <p  class="text-right">{{ date('Y年m月d日') }}</p>
                        <p  class="text-right">{{ optional($ceremony_info)->groom_name }}  {{ optional($ceremony_info)->bride_name }}</p>
                        <br>
                        <p class="text-right text-xs text-slate-400">※ご出席について確認が取れ次第、こちらは表示されなくなります</p>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
    <section id="ceremony_info">
        <div class="w-full mt-10 pb-10">
            @if ($ceremony_info)
            {{-- 開催日 --}}
            <p class="text-center mt-5">日時：{{ optional($ceremony_info)->wedding_date }}</p>
            {{-- 受付開始時間 --}}
            <p class="text-center mt-2">受付 開始時間：{{ optional($ceremony_info)->reception_time }}</p>
            {{-- 挙式開始時間 --}}
            <p class="text-center mt-2">結婚式 開始時間：{{ optional($ceremony_info)->start_ceremony_time }}</p>
            {{-- 披露宴開始時間 --}}
            <p class="text-center mt-2">披露宴 開始時間：{{ optional($ceremony_info)->start_wedding_reception_time }}</p>
            {{-- 住所 --}}
            <p class="text-center mt-2">会場住所：{{ optional($ceremony_info)->address }}</p>
            {{-- 会場名 --}}
            <p class="text-center mt-2">会場：{{ optional($ceremony_info)->place_name }}</p>
    
            <div class="w-full flex justify-center">
                @if (optional($ceremony_info))
                <div id="map" class="w-11/12 md:w-1/2 h-96 mt-5 bg-slate-500 mb-5">
                    {{-- 何も記入しない --}}
                </div>                     
                @endif
            </div>
            @else
            <p class="text-center mt-5">日時設定がされておりません。</p>
            <p class="text-center mt-2">主催者までご確認ください。</p>
            @endif
        </div>
    </section>
    <input type="hidden" id="venue_address" value="{{ optional($ceremony_info)->address }}"> {{-- この値を受け取って地図を表示している --}}

    @if (Auth::User()->is_answered === 0)
    <script type="text/javascript" src="{{ mix('js/popup_confirmation.js') }}"></script>    
    @endif
    @if ($ceremony_info)
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MIX_GOOGLE_MAPS_API_KEY') }}"></script>
    <script type="text/javascript" src="{{ mix('js/googleMapsApi.js') }}"></script>
    @endif
</x-app-layout>

