<style>

    @font-face { font-family: Shabnam; src: url('landing_assets/fonts/Shabnam.ttf'); }
    @font-face { font-family: Shabnam; font-weight: bold; src: url('landing_assets/fonts/Shabnam.ttf');}

    .h1,h2,h3,h4,h5,div,x-input-label,x-primary-button {
        font-family: Shabnam,serif;
    }

</style>


<x-guest-layout>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('handle.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('شماره همراه')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" required autofocus autocomplete="username" placeholder="اعداد را به انگلیسی وارد کنید" />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">
            {{--@if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif--}}

            <x-primary-button class="ml-3">
                {{ __('ورود') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
