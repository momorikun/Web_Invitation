{{-- 出席者一覧のセクション --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5" id="planToAttendedUserSection">
    <h2 class="border-b border-grey-400">出席者一覧</h2>
    <div class="p-6 bg-white flex justify-center">
        <a href="/admin/attend_pdf" class="btn btn-active btn-ghos">出席者一覧を表示する</a>
    </div>
    <noscript>
        <p class="text-red-500 underline">JavaScriptを有効にしてからご利用くださいませ。</p>
    </noscript>
    <h2 class="border-b border-grey-400">ゲスト検索</h2>
    <h3 class="mt-6">ピンポイント検索</h3>
    <x-auth-validation-errors class="mb-4" :errors="$errors->guestInfoUpdate" />
    <form id="guestSearch">
        <label for="guestSearchInputKana" class="label">
            <span class="label-text">ゲスト名</span>
        </label>
        <input type="text" id="guestSearchInputKana" name="guestSearchInputKana" class="input input-bordered dark:bg-white" placeholder="フリガナ">
        <input type="hidden" id="guestSearchCeremonyId" value="{{ Auth::User()->ceremonies_id }}">
        <button type="button" id="guestSearchButton" class="btn btn-active btn-ghos">ゲスト検索</button>
    </form>
    <h3 class="mt-6">条件検索</h3>
    <x-auth-validation-errors class="mb-4" :errors="$errors->aboutGuestSearch" />
    <form id="aboutGuestSearch" class="mt-2 w-full flex  items-end">
        <div>
            <label for="genderSelectBox" class="label">
                <span class="label-text">性別</span>
            </label>
            <select name="genderSelectBox" id="genderSelectBox" class="input input-bordered dark:bg-white pr-10">
                <option value="" selected>----</option><!-- /.genderSelectBoxItem -->
                <option value="0">男性</option><!-- /.genderSelectBoxItem -->
                <option value="1">女性</option><!-- /.genderSelectBoxItem -->
                <option value="2">その他</option><!-- /.genderSelectBoxItem -->
            </select>
        </div>
        <div class="mx-5 px-auto">
            <label for="whichSideSelectBox" class="label">
                <span class="label-text">どちらの関係者</span>
            </label>
            <select name="whichSideSelectBox" id="whichSideSelectBox" class="input input-bordered w-full dark:bg-white pr-10">
                <option value="" selected>----</option>
                <option value="0">新郎</option>
                <option value="1">新婦</option>
            </select>
        </div>
        <div>
            <label for="relationshipSelectBox" class="label">
                <span class="label-text">間柄</span>
            </label>
            <select name="relationshipSelectBox" id="relationshipSelectBox" class="input input-bordered dark:bg-white pr-10">
                <option value="">----</option>
                <option value="0">親</option>
                <option value="1">姉弟</option>
                <option value="2">祖父母</option>
                <option value="3">親戚</option>
                <option value="4">友人</option>
                <option value="5">同僚</option>
                <option value="6">上司</option>
                <option value="7">部下</option>
                <option value="8">その他</option>
            </select><!-- /# -->
        </div>
        <button type="button" id="guestSearchWithRelationshipButton" class="btn btn-active btn-ghos ml-1">ゲスト検索</button>
    </form>
</div>
