<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{route('home')}}" class="logo-holder" style="margin-top: 5px;"><img class="h-20 w-20" src="{{url('panel/assets/media/image/login2.png')}}" alt=""></a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="login" value="ایمیل یا شماره موبایل" />
                <x-jet-input id="login" class="block mt-1 w-full" type="text" name="login"  required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="رمز عبور" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="mr-2 text-sm text-gray-600">مرا به خاطر بسپار</span>
                </label>
            </div>

            <div class="flex items-center justify-start mt-4 ml-4">

                <x-jet-button class="ml-4">
                    ورود
                </x-jet-button>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 ml-4" href="{{ route('password.request') }}">
                        رمز عبور را فراموش کرده ام؟
                    </a>
                @endif


            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
