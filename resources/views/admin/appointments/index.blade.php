<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Записи всех питомцев
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
                @if(\App\Models\Appointment::all()->count() > 0)
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
                                Дата и время
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-center text-sm leading-4 tracking-wider">
                                Статус
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                Действие
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="trix-content">
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    {{ $appointment->pet->pet_name }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    {{ $appointment->pet->type->pet_type }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    {{ $appointment->user->name }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    {{ Date::parse($appointment->day)->format('j F Y') }}
                                    <br>
                                    {{ $appointment->time }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-sm leading-5">
                                    <label class="flex items-center">
                                        <input class="status relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-400 cursor-pointer rounded-full shadow-inner outline-none appearance-none"
                                               type="checkbox" data-on="Completed" data-off="pending" data-toggle="toggle"
                                               {{ $appointment->status == 'completed' ? 'checked' : '' }}
                                               name="status" value="{{ $appointment->id }}" id="status"/>
                                    </label>
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5">
                                    <form action="{{ route('admin-appointments.destroy', $appointment['id']) }}" method="POST">
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
                    <p class="mt-6">В клинику пока не записано ни одного питомца</p>
                @endif
            </div>
        </div>
    </div>
    <style>
        input:before {
            content: '';
            position: absolute;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            top: 0;
            left: 0;
            transform: scale(1.1);
            box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.2);
            background-color: white;
            transition: .2s ease-in-out;
        }

        input:checked {
            @apply: bg-indigo-400;
            background-color:#7f9cf5;
        }

        input:checked:before {
            left: 1.25rem;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('input[name=status]').change(function () {
            var mode=$(this).prop('checked');
            var id=$(this).val();
            $.ajax({
                url: "{{ route('appointments.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id
                },
            })
        });
    </script>
</x-app-layout>
