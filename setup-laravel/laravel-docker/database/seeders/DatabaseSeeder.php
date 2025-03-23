<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            EmpresaSeeder::class,
            UsuarioSeeder::class,
            VagaSeeder::class,
            CandidaturaSeeder::class,
        ]);
    }
}
