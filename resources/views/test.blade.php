@section('title', '| 主催者')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">

                {{ $res }}
                
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


