<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nome' => 'Usuario A',
                'email' => 'usuarioA@example.com',
                'cpf' => '12345678901',
                'senha' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Usuario B',
                'email' => 'usuarioB@example.com',
                'cpf' => '12345678902',
                'senha' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
