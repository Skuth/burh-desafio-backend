<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VagaSeeder extends Seeder
{
    public function run()
    {
        // Inserir empresas primeiro
        DB::table('empresas')->insert([
            ['nome' => 'Empresa 1', 'cnpj' => '12345678000195', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Empresa 2', 'cnpj' => '12345678000196', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Inserir vagas depois
        DB::table('vagas')->insert([
            ['titulo' => 'Vaga Desenvolvedor', 'descricao' => 'Descrição da vaga para desenvolvedor', 'empresa_id' => 1, 'tipo_vaga' => 'PJ', 'salario' => 5000, 'horario' => 40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['titulo' => 'Vaga Designer', 'descricao' => 'Descrição da vaga para designer', 'empresa_id' => 2, 'tipo_vaga' => 'CLT', 'salario' => 4000, 'horario' => 40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

