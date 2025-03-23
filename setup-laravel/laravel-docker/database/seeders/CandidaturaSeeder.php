<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidaturaSeeder extends Seeder
{
    public function run()
    {
        DB::table('candidaturas')->insert([
            [
                'usuario_id' => 1, // Assumindo que o usuário com id 1 existe
                'vaga_id' => 1, // Assumindo que a vaga com id 1 existe
                'mensagem' => 'Gostaria de me candidatar a esta vaga.',
                'status' => 'Pendente',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => 2, // Assumindo que o usuário com id 2 existe
                'vaga_id' => 2, // Assumindo que a vaga com id 2 existe
                'mensagem' => 'Tenho interesse nesta oportunidade.',
                'status' => 'Pendente',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
