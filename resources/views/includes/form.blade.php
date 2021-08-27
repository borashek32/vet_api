<form method="POST" action="{{ route('appointments.store') }}" class="container mx-auto max-w-md shadow-md hover:shadow-lg transition duration-300">
    @csrf
    <div class="py-12 p-10 bg-white rounded-xl">
        <div class="mb-6">
            <label class="mr-4 text-gray-700 font-bold inline-block mb-2 mr-6" for="user_id">
                Ваше имя
            </label>

            <input type="text" class="border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2
                            focus:ring-indigo-400 rounded" name="user_id"
                   placeholder="Иванов Иван" value="{{ Auth::user()->name }}" />
        </div>

        <div class="mb-6">
            <label class="mr-4 text-gray-700 font-bold inline-block mb-2 mr-6" for="pet_id">
                Вид питомца
            </label>

            <select name="type_id" class="form-select border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2
                            focus:ring-indigo-400 rounded" aria-label="Default select example">
                <option value="{{ old('type_id') }}" selected>Выберите вид питомца</option>
                @foreach($user->types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->pet_type }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="mr-4 text-gray-700 font-bold inline-block mb-2 mr-6" for="pet_id">
                Имя питомца
            </label>

            <select name="pet_id" class="form-select border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2
                            focus:ring-indigo-400 rounded" aria-label="Default select example">
                <option value="{{ old('pet_id') }}" selected>Выберите питомца</option>
                @foreach($user->pets as $pet)
                    <option value="{{ $pet->id }}">
                        {{ $pet->pet_name }}
                    </option>
                @endforeach
            </select>
            <p class="text-left text-xs mb-2">* Перед записью питомца на прием убедитесь, что вы внесли его в базу данных клиники в своем личном кабинете</p>
        </div>

        <div class="mb-6">
            <label class="mr-4 text-gray-700 font-bold inline-block mb-2 mr-6" for="day">
                День записи
            </label>
            <input type="text" class="border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2
                            focus:ring-indigo-400 rounded" name="day" placeholder="2021-10-01" />
        </div>

        <div class="mb-6">
            <label class="mr-4 text-gray-700 font-bold inline-block mb-2 mr-6" for="time">
                Время записи
            </label>
            <input type="text" class="border bg-gray-100 py-2 px-4 w-96 outline-none focus:ring-2
                            focus:ring-indigo-400 rounded" name="time" placeholder="12:00:00" />
        </div>

        <x-jet-button>
            {{ __('Записать') }}
        </x-jet-button>
    </div>
</form>
