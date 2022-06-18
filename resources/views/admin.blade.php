<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <h2 class="border-b border-grey-400">出席者一覧</h2>
                    <div class="p-6 bg-white flex justify-center">
                        <a href="/admin/attend_pdf" class="btn btn-active btn-ghos">PDFで表示する</a>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">QRコード読み取り</h2>
                    
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">招待状送付</h2>
                    <p class="text-gray-400">※PC版LINEでは動作しません。</p>
                    <p class="text-gray-400">送付はスマートフォンから行ってください。 </p>
                    <div class="p-6 bg-white flex justify-center">
                        <a href="https://line.me/R/share?text=ここにURLエンコードしたテキストを入力する" class="btn btn-active btn-ghos" target="_blank"  rel="noopener noreferrer">招待状を送付する</a>
                    </div>
                    {{-- //TODO:LINE URLスキーマで送付機能 URLエンコードを行う --}}
                    {{-- //TODO:招待文は季節にあったもの、結婚式への招待か披露宴への招待かなどによって文面が異なる --}}
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">座席表アップロード</h2>
                    
                </div>
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
                        {{-- //TODO:action先設定 --}}
                        <form method="POST" action="{{-- {{ route('upload_photo') }} --}}" class="block w-full">
                            @csrf
                            <h3 class="w-full text-lg">開催日</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
                                <div class="form-control w-full max-w-xs">
                                    <label for="ceremonies_dates_year" class="label">
                                        <span class="label-text">year</span>
                                    </label>
                                    <select class="select select-bordered" id="ceremonies_dates_year" name="ceremonies_dates_year">
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
                                    <select class="select select-bordered" id="ceremonies_dates_month" name="ceremonies_dates_month">
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
                                    <select class="select select-bordered" id="ceremonies_dates_day" name="ceremonies_dates_day">
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
                                    <input type="time" class="select select-bordered" id="ceremonies_dates_time" name="ceremonies_dates_time">
                                </div>
                            </div>
                            
                            <h3 class="w-full text-lg mt-4">会場</h3>
                            <div class="grid grid-cols-2 w-full justify-center mx-auto">
                                {{-- //TODO: 会場の住所カラムを追加する --}}
                                {{-- //TODO:Yahoo!ローカルサーチAPIの登録、住所からジオコーディング --}}
                                <div class="form-control w-full max-w-xs">
                                    <label for="place_name" class="label">
                                        <span class="label-text">chapel / venue name</span>
                                    </label>
                                    <input type="text" class="input input-bordered" id="place_name" name="place_name" placeholder="会場名">
                                </div>
                                <div class="form-control w-full max-w-xs px-1">
                                    <label for="place_address" class="label">
                                        <span class="label-text">Address</span>
                                    </label>
                                    <input type="text" class="input input-bordered" id="place_address" name="place_address">
                                </div>
                            </div>                            

                            <input type="hidden" name="upload_user_id" value="{{ Auth::User()->id }}">
                            <div class="w-full flex justify-end mt-5">
                                <button type="submit" class="btn btn-active btn-ghos">アップロード</button>
                                {{-- <a href="/delete_photo" class="btn btn-active btn-ghos ml-1">編集</a> --}}
                            </div>
                        </form>
                        <h2 class="border-b border-grey-400">開催場所情報</h2>
                        <div>

                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
                    <h2 class="border-b border-grey-400">アルバム掲示</h2>
                    <div class="p-0 mt-4 bg-white">
                        @if (count($errors) > 0)
                            <div>
                                <div class="font-medium text-red-600">
                                    {{ __('Whoops! Something went wrong.') }}
                                </div>
    
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
                            <input type="file" name="file[]" multiple>
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
            </div>
        </div>
    </div>
</x-app-layout>
<script tye="text/javascript" src="{{ mix('js/date_selectbox.js') }}"></script>
