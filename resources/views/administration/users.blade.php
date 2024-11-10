
@extends('layouts.template')

@section('content')
<div class="container mt-4">
    <h3 class="title text-center">Administrar Roles de Usuarios</h3>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="email" class="form-control" placeholder="Buscar por email" value="{{ request('email') }}">
            <button type="submit" class="btn btn-primary" style="background-color: #382B19; border-color: #382B19;">Buscar</button>
        </div>
    </form>

    

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol Actual</th>
                <th class="text-center" style="width: 1%;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRoleNames()->first() ?? 'Sin Rol' }}</td>
                <td class="text-center">
                    <div class="d-flex justify-content-center">
                        <form class="d-inline">
                            @csrf
                            <div class="input-group">
                                <select name="role" class="form-select role-select" data-user-id="{{ $user->id }}" style="width: auto;">
                                    <option value="">Quitar Rol</option>
                                    <option value="Administrador" {{ $user->hasRole('Administrador') ? 'selected' : '' }}>Asignar Administrador</option>
                                </select>
                            </div>
                        </form>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="background-color: #382B19; border-color: #382B19;">Borrar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginador -->
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('.role-select').change(function() {
        var userId = $(this).data('user-id');
        var role = $(this).val();
        var token = $('input[name="_token"]').val();

        if (confirm('¿Estás seguro de que quieres asignar este rol?')) {
            $.ajax({
                url: '/users/' + userId + '/role',
                method: 'POST',
                data: {
                    _token: token,
                    role: role
                },
                success: function(response) {
                    alert('Rol asignado correctamente.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error al asignar el rol.');
                }
            });
        }
    });

    
});
</script>
@endsection