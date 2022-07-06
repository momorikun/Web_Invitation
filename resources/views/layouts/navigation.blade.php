
@if( Request::routeIs('dashboard'))
<nav id="nav" x-data="{ open: false }" class="bg-white bg-opacity-1 border-b border-gray-100 py-2">
@else
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 py-2">
@endif
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if (Auth::User()->user_categories_id === 1)
                    <a href="{{ route('admin') }}"> 
                    @else
                    <a href="{{ route('dashboard') }}">
                    @endif
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-center mt-4 mb-2">
        <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
            @if(Route::currentRouteName() === 'admin')
              <li>
                <a href="#nav" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</a>
              </li>
              <li>
                <a href="#invitation" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Invitation</a>
              </li>
              <li>
                <a href="#seating-chart" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Seating Chart</a>
              </li>
              <li>
                <a href="#ceremony-info" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Ceremony Info Setting</a>
              </li>
              <li>
                <a href="#album" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Album</a>
              </li>
              <li>
                <a href="#questions" class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Questions</a>
              </li>
              <li>
                <a href="{{ route('message_page') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Messages</a>
              </li>
              <li>
                <a href="{{ route('dashboard') }}" class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Guest Page</a>
              </li>
            @else
            <li>
                <a href="{{ route('dashboard') }}" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</a>
              </li>
              <li>
                <a href="{{ route('dashboard') }}/#ceremony_info" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Ceremony info</a>
              </li>
              <li>
                <a href="{{ route('seating_chart') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Seating chart</a>
              </li>
              <li>
                <a href="{{ route('about_us') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About us</a>
              </li>
              <li>
                <a href="{{ route('question_for_guest') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Question</a>
              </li>
              <li>
                <a href="{{ route('album_page') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Album</a>
              </li>
              <li>
                <a href="{{ route('qrcode_for_checkin') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">CheckIn QRcode</a>
              </li>
              
              <li>
                <a href="{{ route('message_for_couple') }}" class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Message</a>
              </li>
            @endif
            </ul>
            
          </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Route::currentRouteName() === 'admin')
            <x-responsive-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                {{ __('Top') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#invitation" :active="request()->routeIs('admin')">
                {{ __('招待する') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#seating-chart" :active="request()->routeIs('admin')">
                {{ __('座席表') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#ceremony-info" :active="request()->routeIs('admin')">
                {{ __('式詳細設定') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('album_page')" :active="request()->routeIs('admin')">
                {{ __('アルバム') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#questions" :active="request()->routeIs('admin')">
                {{ __('質問設定') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('message_page')" :active="request()->routeIs('admin')">
                {{ __('メッセージ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('admin')">
                {{ __('ゲストページ') }}
            </x-responsive-nav-link>
            @else
            <x-responsive-nav-link :href="route('admin')" :active="request()->routeIs('dashboard')">
                {{ __('Top') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('seating_chart')" :active="request()->routeIs('dashboard')">
                {{ __('座席表') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#ceremony-info" :active="request()->routeIs('dashboard')">
                {{ __('式詳細') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about_us')" :active="request()->routeIs('dashboard')">
                {{ __('新郎新婦について') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('question_for_guest')" :active="request()->routeIs('dashboard')">
                {{ __('質問回答') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('album_page')" :active="request()->routeIs('dashboard')">
                {{ __('アルバム') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('qrcode_for_checkin')" :active="request()->routeIs('dashboard')">
                {{ __('QRコード') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('message_for_couple')" :active="request()->routeIs('dashboard')">
                {{ __('メッセージ') }}
            </x-responsive-nav-link>

            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
