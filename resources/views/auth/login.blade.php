@extends('layouts.guest')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="login-form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3" id="login">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
@endsection

@section('scripts')
<script id="login-script">
// Intercepted button click to do this with an AJAX request --RS 2024-02-27
document.addEventListener('DOMContentLoaded', function () {
    var login = document.getElementById('login');
    if(login) {
        login.addEventListener('click', function(ev) {
            ev.preventDefault();

            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var remember_me = document.getElementById('remember_me');

            axios.post('/login', {
                "email": email.value,
                "password": password.value,
                "remember": remember_me.value
            }).then(function(response) {
                window.location = {{ route('dashboard') }};
            }).catch(function(error) {
                console.error(error);
                alert('Email and/or password was not correct');
            });
        })
    }
});
</script>
@stop
