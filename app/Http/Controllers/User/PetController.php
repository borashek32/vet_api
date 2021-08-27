<?php

namespace App\Http\Controllers\User;

use App\Models\Pet;
use App\Models\Type;
use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PetController extends Controller
{
    /**
     * Вывод всех питомцев пользователя
     */
    public function index()
    {
        $user = Auth::user();

        return view('user.pets.index', compact('user'));
    }

    /**
     * Форма создания нового питомца пользователя
     */
    public function create()
    {
        $types = Type::all();

        return view('user.pets.create', compact('types'));
    }

    /**
     * Создание нового питомца в базе данных клиники
     */
    public function store(Request $request)
    {
        Pet::create([
            'user_id'       => Auth::user()->id,
            'pet_name'      => $request->pet_name,
            'type_id'       => $request->type_id
        ]);

        TypeUser::create([
            'type_id'    => $request->type_id,
            'user_id'    => Auth::user()->id
        ]);

        return redirect('/dashboard/user/pets')
            ->with('success', 'Новый питомец был успешно добавлен');
    }

    /**
     * Редавктирование информации о питомце
     */
    public function edit(Pet $pet)
    {
        $types = Type::all();

        return view('user.pets.edit', compact('types', 'pet'));
    }

    /**
     * Обновление информации о питомце
     */
    public function update(Request $request, Pet $pet)
    {
        $pet->type_id   =  $request->type_id;
        $pet->pet_name  =  $request->pet_name;
        $pet->save();

        return redirect('dashboard/user/pets')
            ->with('success', 'Информация о питомце была успешно обновлена.');
    }

    /**
     * Удаление информации о питомце
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect('dashboard/user/pets')
            ->with('success', 'Информация о питомце была успешно удалена.');
    }
}
