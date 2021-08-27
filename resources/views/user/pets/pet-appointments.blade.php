<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Записи вашего питомца {{ $pet->pet_name }}
            </h2>
        </div>
    </header>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
                <div class="bg-indigo-300 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if (session()->has('success'))
                        <div class="bg-indigo-300 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                        <div class="flex justify-between">
                            <div class="text-left">
                                <a href="/">
                                    <button class="mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Записаться
                                    </button>
                                </a>
                            </div>
                        </div>
                        <table class="table-fixed w-full">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Имя питомца
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Дата и время
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Действие
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pet->appointments as $appointment)
                                <tr class="trix-content">
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                        {{ $appointment->pet->pet_name }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                        {{ Date::parse($appointment->day)->format('j F Y') }}
                                        <br>
                                        {{ $appointment->time }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" style="cursor: pointer" value="Удалить" class="bg-red-500 hover:bg-red-700
                                    text-white font-bold py-2 px-4 rounded">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
