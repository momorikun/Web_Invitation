<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        {{-- <!-- Validation Errors --> --}}
        <x-auth-validation-errors class="mb-4" :errors="$errors->register"/>
        
        
        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="grid grid-cols-2">
                <!-- Name -->
                <div class="mr-1">
                    <x-label for="name" :value="__('名前')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>
                <!-- Kana -->
                <div class="ml-1">
                    <x-label for="kana" :value="__('フリガナ')" />

                    <x-input id="kana" class="block mt-1 w-full" type="text" name="kana" :value="old('kana')" required />
                </div>
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('メールアドレス')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="grid grid-cols-2">
                <!-- Password -->
                <div class="mt-4 mr-1">
                    <x-label for="password" :value="__('パスワード')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 ml-1">
                    <x-label for="password_confirmation" :value="__('パスワード(確認用)')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>
            </div>
            <div id="inputForGuest" class="grid grid-cols-3">
                <div class="mt-4">
                    <x-label for="gender" :value="__('性別')" />

                    <select id="gender" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="gender" required >
                        <option value="">選択してください</option>
                        <option value="0">男性</option>
                        <option value="1">女性</option>
                        <option value="2">その他</option>
                    </select>
                </div>
                <div class="mt-4 mx-2">
                    <x-label for="is_bride_side" :value="__('招待者')" />

                    <select id="is_bride_side" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="is_bride_side" required >
                        <option value="">選択してください</option>
                        <option value="0">新郎</option>
                        <option value="1">新婦</option>
                    </select>
                </div>
                <div class="mt-4">
                    <x-label for="relationship" :value="__('間柄')" />

                    <select id="relationship" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="relationship" required >
                        <option value="">選択してください</option>
                        <option value="0">両親</option>
                        <option value="1">祖父母</option>
                        <option value="2">姉弟</option>
                        <option value="3">子供</option>
                        <option value="4">親戚</option>
                        <option value="5">友人</option>
                        <option value="6">上司</option>
                        <option value="7">同僚</option>
                        <option value="8">部下</option>
                    </select>
                </div>
            </div>
            <!-- ceremonies_id -->
            <div class="mt-4">
                <x-label for="ceremonies_id" value="{{ __('挙式ID') }}" />
                @if(session()->has('error'))
                <div class="mt-3 list-disc list-inside text-sm text-red-600">
                    {{session('error')}}
                </div>
                @endif
                <x-input id="ceremonies_id" class="block mt-1 w-full" type="text" name="ceremonies_id" :value="old('ceremonies_id')" required />
            </div>

            <!-- user_categories_id -->
            <div id="role_flg" class="mt-4 flex">
                <x-label for="user_categories_id" value="{{ __('主催者はこちらをチェックしてください：') }}" />
                <x-input id="user_categories_id" type="checkbox" name="user_categories_id" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('ログインはこちらから') }}
                </a>

                <x-button class="ml-4">
                    {{ __('新規登録') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<script type="text/javascript" src="{{ mix('js/duplicateCheckCeremonyId.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/addInput.js') }}"></script>
