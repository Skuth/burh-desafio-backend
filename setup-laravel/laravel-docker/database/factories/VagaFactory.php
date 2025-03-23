<?php

// database/factories/VagaFactory.php

namespace Database\Factories;

use App\Models\Vaga;
use Illuminate\Database\Eloquent\Factories\Factory;

class VagaFactory extends Factory
{
    protected $model = Vaga::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->jobTitle,
            'descricao' => $this->faker->paragraph,
            'empresa_id' => \App\Models\Empresa::factory()->create()->id,
        ];
    }
}

