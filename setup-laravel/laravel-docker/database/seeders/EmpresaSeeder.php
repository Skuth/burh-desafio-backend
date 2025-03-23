<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    public function run()
    {
        DB::table('empresas')->insert([
            [
                'nome' => 'Empresa X',
                'cnpj' => '12345678000100',
                'plano' => 'Free',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Empresa Y',
                'cnpj' => '12345678000211',
                'plano' => 'Premium',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
