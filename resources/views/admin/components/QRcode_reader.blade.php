{{-- QRコード読み取りのセクション --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
    <h2 class="border-b border-grey-400">出席確認</h2>
    <noscript>
        <p class="text-red-500 underline">JavaScriptを有効にしてからご利用くださいませ。</p>
    </noscript>
    <div class="p-6 bg-white flex justify-center">
        <a href="{{ route('qr_code_reader_mode') }}" class="btn btn-active btn-ghos">QRコードを読み取る</a>
    </div>
</div>