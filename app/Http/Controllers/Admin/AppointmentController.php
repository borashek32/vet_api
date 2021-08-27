<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Записи всех питомцев клиники
     */
    public function index()
    {
        $appointments = Appointment::all();

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Удаление записи на прием
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect('dashboard/admin/appointments')
            ->with('success', 'Запись на прием была успешно удалена.');
    }
}
