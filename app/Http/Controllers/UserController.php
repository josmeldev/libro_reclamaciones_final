<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $users = $query->orderBy('id', 'desc')->paginate(6);

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

        return response()->json(['success' => 'Rol asignado correctamente.']);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario borrado correctamente.');
    }

    
}