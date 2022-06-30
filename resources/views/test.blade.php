<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            {{-- @dd($exist) --}}
            {{-- @dd($request) --}}
            {{-- @dd($old_photo) --}}
            {{-- @dd($request) --}}
            {{-- @dd($address); --}}
            {{-- @php
                
            @endphp
            @dd(gettype($date)) --}}
            @dd($item)
        </div>
    </div>
</x-app-layout>
<script type="text/javascript" src="{{ mix('js/date_selectbox.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/getUsersInformation.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/addQuestion.js') }}"></script>


