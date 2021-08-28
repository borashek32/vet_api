<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Удаление записи на прием в случае ее отмены
     * Вместо статуса DECLINED админ удаляет запись на прием
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect('dashboard/admin/appointments')
            ->with('success', 'Запись на прием была успешно удалена.');
    }

    /**
     * Статус записи меняет врач или админ клиники по окончанию времени приема
     */
    public function appointmentStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('appointments')->where('id', $request->id)
                ->update(['status' => 'completed']);

            return response()->json([
                'status' => true
            ]);
        }
        else {
            DB::table('appointments')->where('id', $request->id)
                ->update(['status' => 'pending']);
        }
        return response()->json([
            'status' => false
        ]);
    }
}
