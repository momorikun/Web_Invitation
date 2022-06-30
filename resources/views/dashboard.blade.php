<x-app-layout>
    <x-slot name="header">
    </x-slot>
    {{-- //TODO: 天地中央揃えでQRコード表示するページを作る --}}
    <div class="flex w-full justify-center">
        <div>
            {{ QrCode::size(300)->generate(Auth::User()->uuid) }}
        </div>
    </div>
    @if (count($ceremony_info) > 0)
    <div id="map" class="w-full md:w-1/2 h-96 mt-16 bg-slate-500">
        
    </div>                                
    @endif    
</x-app-layout>
