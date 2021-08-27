<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Записи всех питомцев клиники
     */
    public function index()
    {
        $pets = Pet::all();

        return view('admin.pets.index', compact('pets'));
    }

    /**
     * Удаление записи на прием
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect('dashboard/admin/pets')
            ->with('success', 'Запись на прием была успешно удалена.');
    }
}
