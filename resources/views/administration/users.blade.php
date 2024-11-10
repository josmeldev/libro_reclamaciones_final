@extends('layouts.template')

@section('content')
<div class="container mt-4">
    <h3 class="title text-center">Administrar Roles de Usuarios</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRoleNames()->first() ?? 'Sin Rol' }}</td>
                <td>
                    <form action="{{ route('admin.users.assignRole', $user->id) }}" method="POST">
                        @csrf
                        <select name="role" class="form-select">
                            <option value="">Quitar Rol</option>
                            <option value="Administrador" {{ $user->hasRole('Administrador') ? 'selected' : '' }}>Asignar Administrador</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Asignar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection