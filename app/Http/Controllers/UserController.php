<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('administration.users', compact('users'));
    }

    public function assignRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Quitar todos los roles
        $user->roles()->detach();

        // Asignar nuevo rol si se seleccionó
        if ($request->role) {
            $user->assignRole($request->role);
        }

        return redirect()->route('admin.users.index')->with('success', 'Rol asignado correctamente.');
    }
}
