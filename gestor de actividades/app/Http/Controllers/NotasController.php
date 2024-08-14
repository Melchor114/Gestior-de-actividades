<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotasController extends Controller
{
    public function index() : View
    {
        return view('notas.index');
    }
    public function saveNotes(Request $request)
    {
        $user = Auth::user();
        $user->notes = $request->input('notes');
        $user->save();

        return response()->json(['status' => 'success']);
    }

    public function loadNotes()
    {
        $user = Auth::user();
        return response()->json(['notes' => $user->notes]);
    }
}
