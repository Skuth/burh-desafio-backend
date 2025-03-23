<?php

namespace Tests\Feature;

use App\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_empresa()
    {
        $data = [
            'nome' => 'Empresa Teste',
            'cnpj' => '12345678901234',
            'plano' => 'Free',
        ];

        $response = $this->postJson('/empresas', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

    // Verifica se a empresa foi criada no banco de dados
     /*     $this->assertDatabaseHas('empresas', [
            'nome' => 'Nova Empresa',
            'cnpj' => '12345678901234',
            'plano' => 'Free',
        ]);  */
    }
    public function test_can_get_empresa()
    {
        $empresa = Empresa::factory()->create();

        $response = $this->getJson('/empresas/' . $empresa->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => $empresa->nome]);
    }
    public function test_can_update_empresa()
    {
        $empresa = Empresa::factory()->create();
        $data = [
            'nome' => 'Novo Nome',
            'cnpj' => '12345678901234',
            'plano' => 'Premium',
        ];

        $response = $this->putJson('/empresas/' . $empresa->id, $data); // Correção aqui

        $response->assertStatus(200)
                ->assertJsonFragment($data);

        // Verifica se o plano foi atualizado no banco de dados
        $this->assertDatabaseHas('empresas', [
            'id' => $empresa->id,
            'plano' => 'Premium',
        ]);
    }

    public function test_can_delete_empresa()
    {
        $empresa = Empresa::factory()->create();

        $response = $this->deleteJson('/empresas/' . $empresa->id); // Correção aqui

        $response->assertStatus(204);

        // Verifica se a empresa foi removida do banco de dados
        $this->assertDatabaseMissing('empresas', ['id' => $empresa->id]);
    }
}
