<?php

namespace Tests\Feature;

use App\Models\Candidatura;
use App\Models\Vaga;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidaturaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_candidatura()
    {
        $usuario = Usuario::factory()->create();
        $vaga = Vaga::factory()->create();

        $data = [
            'usuario_id' => $usuario->id,
            'vaga_id' => $vaga->id,
            'status' => 'pendente',
        ];

        $response = $this->postJson('/candidaturas', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        // Verifica se a candidatura foi criada no banco de dados
      /*   $this->assertDatabaseHas('candidaturas', [
            'usuario_id' => $usuario->id,
            'vaga_id' => $vaga->id,
            'status' => 'pendente',
        ]); */
    }

    public function test_can_get_candidatura()
    {
        $candidatura = Candidatura::factory()->create();

        $response = $this->getJson('/candidaturas/' . $candidatura->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['usuario_id' => $candidatura->usuario_id]);
    }

    public function test_can_update_candidatura()
    {
        $candidatura = Candidatura::factory()->create();

        $data = [
            'status' => 'aprovado',
        ];

        $response = $this->putJson('/candidaturas/' . $candidatura->id, $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        // Verifica se o status foi atualizado no banco de dados
        $this->assertDatabaseHas('candidaturas', [
            'id' => $candidatura->id,
            'status' => 'aprovado',
        ]);
    }

    public function test_can_delete_candidatura()
    {
        $candidatura = Candidatura::factory()->create();

        $response = $this->deleteJson('/candidaturas/' . $candidatura->id);

        $response->assertStatus(204);

        // Verifica se a candidatura foi removida do banco de dados
        $this->assertDatabaseMissing('candidaturas', ['id' => $candidatura->id]);
    }
}

