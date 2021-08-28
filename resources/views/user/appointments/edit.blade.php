<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Редактирование информации о записи питомца
            </h2>
        </div>
    </header>

    <div class="py-4">
        <div class="w-1/3 mx-auto sm:px-6 lg:px-8">
            @include('includes.messages')

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-4">
                        <label for="type_id" class="block text-gray-700 text-sm font-bold mb-2">
                            Вид питомца:
                        </label>

                        <select name="type_id" class="form-select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" aria-label="Default select example">
                            <option>Выберите вид питомца</option>
                            @foreach($user->types as $type)
                                <option value="{{ $type->id }}" @if ($type->id == $appointment->type_id) selected @endif>
                                    {{ $type->pet_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="type_id" class="block text-gray-700 text-sm font-bold mb-2">
                            Имя питомца:
                        </label>

                        <select name="pet_id" class="form-select border py-2 px-4 w-96 outline-none focus:ring-2
                                focus:ring-indigo-400 rounded" aria-label="Default select example">
                            <option value="{{ old('pet_id') }}" selected>Выберите имя питомца</option>
                            @foreach($user->pets as $pet)
                                <option value="{{ $pet->id }}" @if ($pet->id == $appointment->pet_id) selected @endif>
                                    {{ $pet->pet_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="pet_name" class="block text-gray-700 text-sm font-bold mb-2">
                            Дата приема:
                        </label>

                        <input type="text" value="{{ $appointment->day }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="day" name="day" required>
                    </div>

                    <div class="mb-4">
                        <label for="pet_name" class="block text-gray-700 text-sm font-bold mb-2">
                            Время приема:
                        </label>

                        <input type="text" value="{{ $appointment->time }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="time" name="time" required>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <input type="submit" style="cursor: pointer" value="Обновить" class="inline-flex justify-center w-full
                            rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium
                            text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700
                            focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        </span>

                        <a href="{{ route('appointments.index') }}">
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                <button type="button" class="inline-flex justify-center w-full
                                rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium
                                text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300
                                focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Выход
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script>
        $("#day").mask("9999-99-99");
        $("#time").mask("99:99:99");
    </script>
</x-app-layout>
