<x-app-layout>
    <x-slot name="header">
    </x-slot>
    {{-- //TODO: 天地中央揃えでQRコード表示するページを作る --}}
    <div class="flex w-full justify-center">
        <div>
            {{ QrCode::size(300)->generate(Auth::User()->email) }}
        </div>
    </div>
    
</x-app-layout>
