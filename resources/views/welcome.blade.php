<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vet Api</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
        @livewireStyles

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-900 underline">Личный кабинет</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="text-sm text-gray-900 underline" href="{{ route('logout') }}"
                                            style="margin-top: 10px"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Выйти') }}
                            </a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-900 underline">Войти</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-900 underline">Зарегистрироваться</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center">
                <h1 style="font-size: 40px" class="mb-6 font-bold">Vet Api</h1>

                @guest()
                    @include('includes.guest-list')
                @endguest

                @include('includes.messages')

                @auth()
                    @include('includes.form')
                @endauth
            </div>
        </div>
    </body>
</html>
