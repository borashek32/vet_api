<?php

namespace App\Http\Controllers\User;

use App\Models\TypeUser;
use Carbon\Carbon;
use Doctrine\DBAL\Types\Types;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Вывод всех записей питомца одного пользователя через user_id
     */
    public function index()
    {
        $user = Auth::user();
        $appointments = Appointment::where('user_id', $user->id)
            ->orderBy('day', 'DESC')
            ->get();

        return view('user.appointments.index', compact('appointments', 'user'));
    }

    /**
     * Создание записи на прием к врачу
     */
    public function store(Request $request)
    {
        // Проведяем наличие в бд записи на это же время в этот же день
        // Получаем все записи из бд
        $existed_appointments = Appointment::all();

        // Проходим их все в цикле
        foreach ($existed_appointments as $visit) {

            // Сравниваем каждый день и каждое время из бд с создаваемой записью
            if ($visit->day == $request->day && $visit->time == $request->time) {
                return back()->with('error', 'Вы не можете записать своего питомца на это время,
                                        так как оно уже занято');
            }
        }

        // Проверяем не записан ли тот же самый питомец в интервале 2 или 3 дня
        // Допустимый интервал для собаки или кошки - 2 дня, для хомяка - 3 дня
        // Получаем питомца
        $pet = Pet::where('id', $request->pet_id)->first();

        // Проверяем есть ли у питомца записи
        if ($pet->appointments) {

            // Получаем тип питомца
            $pet_type = $request->type_id;

            // В цикле проходим все даты записей
            foreach ($pet->appointments as $appointment) {

                // Для собаки и кошки интервал между записяим составляет 2 дня (1 и 2 типы животных)
                if ($pet_type == 1 || $pet_type == 2) {

                    // Сравниваем дату каждой записи из базы данных с датой создаваемой записи
                    $date1 = Carbon::create($request->day);
                    $date2 = Carbon::create($appointment->day);

                    // Получаем разницу между датами в днях, независимо от
                    // того создаваемая запись будет до или после имеющейся в бд
                    $difference = $date1->diff($date2)->days;

                    if ($difference < 2) {
                        return back()->with('error', 'Вы не можете записать своего питомца на прием
                                                    c интервалом менее, чем 2 дня');
                    } else {
                        Appointment::create([
                            'user_id'   => Auth::user()->id,
                            'pet_id'    => $request->pet_id,
                            'type_id'   => $request->type_id,
                            'day'       => $request->day,
                            'time'      => $request->time
                        ]);
                        return back()->with('success', 'Ваш питомец успешно записан на прием');
                    }
                }

                // Для хомяка интервал между записяим составляет 3 дня (3 тип животного)
                if ($pet_type == 3) {

                    // Сравниваем дату каждой записи из базы данных с датой создаваемой записи
                    $date1 = Carbon::create($request->day);
                    $date2 = Carbon::create($appointment->day);

                    // Получаем разницу между датами в днях, независимо от
                    // того создаваемая запись будет до или после имеющейся в бд
                    $difference = $date1->diff($date2)->days;

                    if ($difference < 3) {
                        return back()->with('error', 'Вы не можете записать своего питомца на прием
                                                    c интервалом менее, чем 3 дня');
                    } else {
                        Appointment::create([
                            'user_id'   => Auth::user()->id,
                            'pet_id'    => $request->pet_id,
                            'type_id'   => $request->type_id,
                            'day'       => $request->day,
                            'time'      => $request->time
                        ]);
                        return back()->with('success', 'Ваш питомец успешно записан на прием');
                    }
                }
            }
        }
        Appointment::create([
            'user_id'   => Auth::user()->id,
            'pet_id'    => $request->pet_id,
            'type_id'   => $request->type_id,
            'day'       => $request->day,
            'time'      => $request->time
        ]);
        return back()->with('success', 'Ваш питомец успешно записан на прием');
    }

    /**
     * Редактирование записи на прием в личном кабинете пользователя
     */
    public function edit(Appointment $appointment)
    {
        $user       = Auth::user();
//        $pets       = Pet::where('user_id', $user->id)->get();

        return view('user.appointments.edit', compact('appointment', 'user'));
    }

    /**
     * Обновление записи
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Проведяем наличие в бд записи на это же время в этот же день
        // Получаем все записи из бд
        $existed_appointments = Appointment::all();

        // Проходим их все в цикле
        foreach ($existed_appointments as $visit) {

            // Сравниваем каждый день и каждое время из бд с создаваемой записью
            if ($visit->day == $request->day && $visit->time == $request->time) {
                return back()->with('error', 'Вы не можете записать своего питомца на это время,
                                        так как оно уже занято');
            }
        }

        // Проверяем не записан ли тот же самый питомец в интервале 2 или 3 дня
        // Допустимый интервал для собаки или кошки - 2 дня, для хомяка - 3 дня
        // Получаем питомца
        $pet = Pet::where('id', $appointment->pet_id)->first();

        // Проверяем есть ли у питомца записи
        if ($pet->appointments) {

            // Проверяем обновил ли пользователь инфо в записи
            foreach ($pet->appointments as $visit) {

                // Сравниваем каждую запись питомца из бд с создаваемой записью
                if ($visit->day == $request->day && $visit->time == $request->time) {
                    return back()->with('error', 'Вы не обновили запись питомца');
                }
            }

            // Получаем тип питомца
            $pet_type = $appointment->type_id;

            // В цикле проходим все даты записей
            foreach ($pet->appointments as $appointment) {

                // Для собаки и кошки интервал между записяим составляет 2 дня (1 и 2 типы животных)
                if ($pet_type == 1 || $pet_type == 2) {

                    // Сравниваем дату каждой записи из базы данных с датой создаваемой записи
                    $date1 = Carbon::create($request->day);
                    $date2 = Carbon::create($appointment->day);

                    // Получаем разницу между датами в днях, независимо от
                    // того создаваемая запись будет до или после имеющейся в бд
                    $difference = $date1->diff($date2)->days;

                    if ($difference < 2) {
                        return back()->with('error', 'Вы не можете записать своего питомца на прием
                                                    c интервалом менее, чем 2 дня');
                    } else {
                        $appointment->pet_id    =  $request->pet_id;
                        $appointment->type_id   =  $request->type_id;
                        $appointment->day       =  $request->day;
                        $appointment->time      =  $request->time;
                        $appointment->save();

                        return back()->with('success', 'Запись успешно обновлена');
                    }
                }

                // Для хомяка интервал между записяим составляет 3 дня (3 тип животного)
                if ($pet_type == 3) {

                    // Сравниваем дату каждой записи из базы данных с датой создаваемой записи
                    $date1 = Carbon::create($request->day);
                    $date2 = Carbon::create($appointment->day);

                    // Получаем разницу между датами в днях, независимо от
                    // того создаваемая запись будет до или после имеющейся в бд
                    $difference = $date1->diff($date2)->days;

                    if ($difference < 3) {
                        return back()->with('error', 'Вы не можете записать своего питомца на прием
                                                    c интервалом менее, чем 3 дня');
                    } else {
                        $appointment->pet_id    =  $request->pet_id;
                        $appointment->type_id   =  $request->type_id;
                        $appointment->day       =  $request->day;
                        $appointment->time      =  $request->time;
                        $appointment->save();

                        return back()->with('success', 'Запись успешно обновлена');
                    }
                }
            }
        }
        $appointment->pet_id    =  $request->pet_id;
        $appointment->type_id   =  $request->type_id;
        $appointment->day       =  $request->day;
        $appointment->time      =  $request->time;
        $appointment->save();

        return back()->with('success', 'Запись успешно обновлена');



        // Добавить перед обновлением записи такую же проверку, как и в store
//        $appointment->pet_id    =  $request->pet_id;
//        $appointment->type_id   =  $request->type_id;
//        $appointment->day       =  $request->day;
//        $appointment->time      =  $request->time;
//        $appointment->save();
//
//        return redirect('dashboard/appointments')
//            ->with('success', 'Информация о питомце была успешно обновлена.');
    }

    /**
     * Удаление записи пользователем
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect('dashboard/appointments')
            ->with('success', 'Запись на прием была успешно удалена.');
    }
}
