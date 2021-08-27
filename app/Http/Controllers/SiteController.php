<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    /**
     * Главная страница сайта Vet Api
     */
    public function index()
    {
        $types = Type::all();
        $user  = Auth::user();

        return view('welcome', compact('types', 'user'));
    }
}
