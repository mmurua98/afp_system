<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate tables
        DB::statement('SET foreign_key_checks=0');
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            Permission::truncate();
            Role::truncate();
        DB::statement('SET foreign_key_checks=1');


        //user admin
        $useradmin = User::where('email', 'admin@admin.com')->first();
        if ($useradmin){
            $useradmin->delete();
        }
        $useradmin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);

        //rol admin
        $roladmin=Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator',
            'full-access' => 'yes'
        ]);
        
        //table role_user
        $useradmin->roles()->sync([$roladmin->id]);

        //permission
        $permission_all = [];

        //permission role GENERAR ORDEN
        $permission = Permission::create([
            'name' => 'Generar Orden',
            'slug' => 'order.index',
            'description' => 'Puede generar ordenes de compra'
        ]);

        $permission_all[] = $permission->id;

        //permission role VER/IMPRIMIR ORDEN
        $permission = Permission::create([
            'name' => 'Ver/Imprimir Orden',
            'slug' => 'historial.index',
            'description' => 'Puede ver/imprimir ordenes de compra'
        ]);

        //permission role ACCESO INVENTARIO
        $permission = Permission::create([
            'name' => 'Acceso Inventario',
            'slug' => 'stock.index',
            'description' => 'Puede generar ordenes de compra'
        ]);

        $permission_all[] = $permission->id;

        //permission role ACCESO USUARIOS
        $permission = Permission::create([
            'name' => 'Acceso Usuarios',
            'slug' => 'user.index',
            'description' => 'Puede generar ordenes de compra'
        ]);

        //table permission_role
        //$roladmin->permissions()->sync($permission_all);
    }
}
