@section('title', '| 主催者')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">

                {{-- 出席者関連のセクション --}}
                @include('admin.components.guest_list')

                {{-- QRコード読み取りのセクション --}}
                @include('admin.components.QRcode_reader')

                {{-- 招待状送付のセクション --}}
                @include('admin.components.send_invitation')
                
                {{-- 座席アップロードセクション --}}
                @include('admin.components.seating_section')
                
                {{-- 挙式についての設定セクション --}}
                @include('admin.components.ceremony_setting')

                {{-- アルバム掲示セクション --}}
                @include('admin.components.album')

                {{-- ふたりへの質問のセクション --}}
                @include('admin.components.QA')

                {{-- 逆Q&Aセクション --}}
                @include('admin.components.QAforGuest')
                
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


