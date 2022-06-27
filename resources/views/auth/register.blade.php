<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
        
        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('名前')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            <!-- Kana -->
            <div class="mt-4">
                <x-label for="kana" :value="__('フリガナ')" />

                <x-input id="kana" class="block mt-1 w-full" type="text" name="kana" :value="old('kana')" required />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('メールアドレス')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('パスワード')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('パスワード(確認用)')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>
            <!-- ceremonies_id -->
            <div class="mt-4">
                <x-label for="ceremonies_id" value="{{ __('挙式ID') }}" />
                <x-input id="ceremonies_id" class="block mt-1 w-full" type="text" name="ceremonies_id" :value="old('ceremonies_id')" required />
            </div>

            <!-- user_categories_id -->
            <div class="mt-4 flex">
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
