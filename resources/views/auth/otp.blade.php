@push('styles')
    <style>
        .timer-wrapper{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .my-timer{
            /*background-color: #0a53be;*/
            color: #5A5B7E;
            font-size: 1rem;
        }
        #time{
            padding-right:1rem ;
        }


        @font-face { font-family: Shabnam; src: url('landing_assets/fonts/Shabnam.ttf'); }
        @font-face { font-family: Shabnam; font-weight: bold; src: url('landing_assets/fonts/Shabnam.ttf');}

        .h1,h2,h3,h4,h5,div,x-input-label,x-primary-button {
            font-family: Shabnam,serif;
        }

    </style>
@endpush
@push('scripts')
    <script src="{{ asset('landing_assets/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(minutes + ":" + seconds);

                if (--timer < 0) {
                    timer = duration;
                    timer=0;
                }
            }, 1000);
        }

        jQuery(function ($) {
            // var fiveMinutes = 60 * 5,
            var fiveMinutes = {{ $otp_time_remain }},
                display = $('#time');
            startTimer(fiveMinutes, display);

            /*$("#time").click(function (){
                console.log(
                    $("#time").html()
                );
            });*/

        });
    </script>
@endpush
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('otp.handle') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <div class="timer-wrapper">
            <x-input-label for="email" :value="__('کد تایید')" />
            <div class="again-code my-timer"> <a href="{{ route('resend.code') }}">ارسال مجدد کد</a>  <span id="time"> 00:00  </span> </div>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="otp_code" :value="old('otp_code')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <!-- Password -->
        {{--<div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>--}}

        <!-- Remember Me -->
        {{--<div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>--}}

        <div class="flex items-center justify-end mt-4">
            {{--@if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif--}}

            <x-primary-button class="ml-3"  >
                {{ __('ورود') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
