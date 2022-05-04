<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Super Admin',
            'Admin',
            'Gerente',
            'Caixa',
            'Pedidos'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
