<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Все питомцы
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

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if(\App\Models\Pet::all()->count() > 0)
                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                Имя питомца
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                Вид питомца
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                Имя владельца
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                Действие
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pets as $pet)
                            <tr class="trix-content">
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    {{ $pet->pet_name }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    {{ $pet->type->pet_type }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    {{ $pet->user->name }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    <form action="{{ route('admin-pets.destroy', $pet->id) }}" method="POST">
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
                @else
                    <p class="mt-6">В базе данных клиники пока нет ни одного питомца</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
