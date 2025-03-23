<?php

// database/factories/CandidaturaFactory.php

namespace Database\Factories;

use App\Models\Candidatura;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidaturaFactory extends Factory
{
    protected $model = Candidatura::class;

    public function definition()
    {
        return [
            'usuario_id' => \App\Models\Usuario::factory()->create()->id,
            'vaga_id' => \App\Models\Vaga::factory()->create()->id,
            'mensagem' => $this->faker->paragraph,
        ];
    }
}

