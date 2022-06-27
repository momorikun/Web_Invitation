<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>

    <div class="QrCodeReader">
        <video id="camera" class="w-full" muted></video>
        <canvas class="px-0 mx-auto w-1/2" id="canvas" ></canvas>
        <div id="result">
           <small>※ここに読み取り結果が表示されます※</small>
        </div>
    </div>

</x-app-layout>
<script type="text/javascript" src="{{ asset('/js/jsQR.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/qrCodeReader.js') }}"></script>
