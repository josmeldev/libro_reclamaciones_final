<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
        public function run(): void
        {
            
            // Crear roles
            $adminRole = Role::create(['name' => 'Administrador']);
            $userRole = Role::create(['name' => 'Usuario']);
    
            // Crear permisos basados en los names de las rutas
            $permissions = [
                'dashboard.index',
                'admin.consultarReclamosPN',
                'admin.consultarQuejasPN',
                'admin.PN.atendidos',
                'admin.PN.Quejas.atendidos',
                'admin.consultarReclamosPJ',
                'admin.consultarQuejasPJ',
                'admin.PN.Quejas.por_atender',
                'admin.PN.Quejas.en_atencion',
                'admin.PN.Reclamos.por_atender',
                'admin.PN.Reclamos.en_atencion',
                'admin.PJ.Reclamos.por_atender',
                'admin.PJ.Reclamos.en_atencion',
                'admin.PJ.Reclamos.atendidos',
                'admin.PJ.Quejas.en_atencion',
                'admin.PJ.Quejas.atendidos',
                'update.estado',
                'generar.reporte',
                'generar.reporte.pdf',
                'historial.index',
                'reporte.excel',
                'reporte.pdf',
                'form.store'
            ];
    
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
    
            // Asignar todos los permisos al rol admin
            $adminRole->givePermissionTo($permissions);
    
            // Asignar permiso básico al rol user
            $userRole->givePermissionTo('form.store');
    
            // Crear usuario administrador
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);
    
            // Asignar rol de administrador al usuario
            $adminUser->assignRole('Administrador');
        }
    
}
