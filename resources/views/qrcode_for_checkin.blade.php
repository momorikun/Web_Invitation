@section('title', '| 受付用QRコード')
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="flex w-full h-full justify-center mt-10">
        <div>
            {{ QrCode::size(300)->generate(Auth::User()->uuid) }}
        </div>
    </div>
    <div class="flex w-full justify-center mt-10">
        <a href="{{ route('dashboard') }}" class="btn btn-outline">TOPへ戻る</a>
    </div>
    
    
</x-app-layout>

