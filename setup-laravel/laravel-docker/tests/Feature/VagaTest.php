<?php

use App\Models\Vaga;
use App\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VagaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_vaga()
    {
        $empresa = Empresa::factory()->create();

        $data = [
            'titulo' => 'Nova Vaga',
            'tipo_vaga'=> 'PJ',
            'descricao' => 'Descrição da vaga',
            'empresa_id' => $empresa->id,
        ];

        $response = $this->postJson('/vagas', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

     /*    // Verifica se a vaga foi criada no banco de dados
        /* $this->assertDatabaseHas('vagas', [
            'titulo' => 'Nova Vaga',
            'descricao' => 'Descrição da vaga',
            'empresa_id' => $empresa->id,
        ]); */ 
    }

    public function test_can_get_vaga()
    {
        $vaga = Vaga::factory()->create();

        $response = $this->getJson('/vagas/' . $vaga->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['titulo' => $vaga->titulo]);
    }

    public function test_can_update_vaga()
    {
        $vaga = Vaga::factory()->create();

        $data = [
            'descricao' => 'Descrição atualizada',
        ];

        $response = $this->putJson('/vagas/' . $vaga->id, $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        // Verifica se a descrição foi atualizada no banco de dados
        $this->assertDatabaseHas('vagas', [
            'id' => $vaga->id,
            'descricao' => 'Descrição atualizada',
        ]);
    }

    public function test_can_delete_vaga()
    {
        $vaga = Vaga::factory()->create();

        $response = $this->deleteJson('/vagas/' . $vaga->id);

        $response->assertStatus(204);

        // Verifica se a vaga foi removida do banco de dados
        $this->assertDatabaseMissing('vagas', ['id' => $vaga->id]);
    }
}
