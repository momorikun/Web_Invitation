@section('title', '| 主催者')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="justify-between w-full mx-auto">
                
                @foreach ($ceremonies as $ceremony)
                    {{ $ceremony->bride_name }}
                @endforeach    
                
            </div>
        </div>
    </div>
</x-app-layout>