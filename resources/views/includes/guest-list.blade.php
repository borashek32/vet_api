<p class="text-2xl">Для записи питомца на прием:</p>
<ul class="text-left mt-4 mb-2">
    <li>1. Зарегистрируйтесь или войдите под своим именем</li>
    <li class="ml-6 mb-4">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-900 underline">Личный кабинет</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-900 underline">Войти</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-900 underline">Зарегистрироваться</a>
            @endif
        @endauth
    </li>
    <li class="mb-4">2. Добавьте вашего питомца в личном кабинете</li>
    <li class="mb-4">3. Воспользуйтесь формой записи на прием на главной странице</li>
</ul>
