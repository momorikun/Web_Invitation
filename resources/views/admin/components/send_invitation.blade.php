{{-- 招待状送付のセクション --}}
<div id="invitation" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mt-5">
    <h2 class="border-b border-grey-400">招待状送付</h2>
    <p class="text-gray-400">※PC版LINEでは動作しません。</p>
    <p class="text-gray-400">送付はスマートフォンから行ってください。 </p>
    <p class="text-gray-400">記載いただいた文の最後に結婚式IDが追加されます。</p>
    <form action="{{ route('url_encode') }}" method="POST" class="" target="_blank" rel="noopener noreferrer">
        @csrf
        <label for="text" class="label">
            <span class="label-text">招待文</span>
        </label>
        <textarea name="text" id="text" class="textarea textarea-bordered dark:bg-white w-full" cols="30" rows="10">{{ old('text') }}</textarea>
        <input type="hidden" name="send_ceremony_id" value="{{ Auth::User()->ceremonies_id }}">
        <div class="p-6 bg-white flex justify-center">
            <button type="submit" class="btn btn-active btn-ghos">招待状を送付する</button>
        </div>
    </form>
</div>