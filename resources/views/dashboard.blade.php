<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::user()->hasRole('super-admin'))
                {{ __('Административная панель') }}
            @endif

            @if(Auth::user()->hasRole('user'))
                {{ __('Личный кабинет') }}
            @endif
        </h2>
    </x-slot>

    @if(Auth::user()->hasRole('user'))
        <div class="pt-2 mb-4 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>
                    На главной странице вы можете записать своего питомца на прием к врачу
                </p>
            </div>
        </div>

        <div class="pt-2 mb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>
                    На странице питомцев вы можете добавить или удалить информацию о вашем питомце
                </p>
            </div>
        </div>

        <div class="pt-2 mb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>
                    На странице записей питомца вы можете отредактировать или отменить запись на прием к врачу
                </p>
            </div>
        </div>
    @endif

    @if(Auth::user()->hasRole('super-admin'))
        <div class="pt-2 mb-4 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>
                    Администратор может удалять информацию о питомцах из базы данных
                </p>
            </div>
        </div>

        <div class="pt-2 mb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>
                    На странице всех записей клиники администратор может
                </p>
                <ul>
                    <li class="ml-6">отредактировать запись</li>
                    <li class="ml-6">отменить запись</li>
                    <li class="ml-6">поменять статус записи/оставить отметку об окончании приема</li>
                </ul>
            </div>
        </div>
    @endif
    <div class="pt-2 mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>
                В клинике работает один врач, поэтому нет возможности записать несколько питомцев на одно и тоже время
            </p>
        </div>
    </div>

    <div class="pt-2 mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>
                Интервал между приемами одного и тоже питомца составляет
            </p>
            <ul>
                <li class="ml-6">для собак и кошек - два дня</li>
                <li class="ml-6">для хомяков - три дня</li>
            </ul>
        </div>
    </div>
</x-app-layout>
