<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\EmpresaParametros;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresa = Empresa::query()->create([
            'razao_social' => 'Empresa Teste',
            'cnpj' => '00.000.000/0001-00'
        ]);

        EmpresaParametros::query()->create([
            'empresa_id' => $empresa->id,
            'logo' => 'no-image.png',
            'gorjeta' => 10,
            'taxa_entrega' => 2,
            'latitude' => 00,
            'longitude' => 00,
        ]);

        User::query()->create([
            'empresa_id' => $empresa->id,
            'name' => 'Super Admin',
            'username' => 'super',
            'email' => 'admin@email.com',
            'password' => Hash::make('123456')
        ]);
    }
}
