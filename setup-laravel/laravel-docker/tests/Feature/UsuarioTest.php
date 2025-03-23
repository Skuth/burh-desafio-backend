<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Usuario;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_usuario()
    {
        $data = [
            'nome' => 'Novo Usuario',
            'email' => 'usuario@exemplo.com',
            'cpf' => '12345678901', // Certifique-se de que o CPF é uma string
            'senha' => 'senha123',
            'idade' => 20
        ];

        $response = $this->postJson('/usuarios', $data);
      
        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'nome' => 'Novo Usuario',
                     'email' => 'usuario@exemplo.com',
                     'cpf' => '12345678901',
                     'senha' => 'senha123',
                 ]);

        // Verifica se o usuário foi criado no banco de dados
         $this->assertDatabaseHas('usuarios', [
            'nome' => 'Novo Usuario',
            'email' => 'usuario@exemplo.com',
            'cpf' => '12345678901'
        ]); 
    }

    public function test_can_get_usuario()
    {
        $usuario = Usuario::factory()->create();

        $response = $this->getJson('/usuarios/' . $usuario->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => $usuario->nome]);
    }

    public function test_can_update_usuario()
    {
        $usuario = Usuario::factory()->create();

        $data = [
            'nome' => 'Usuario Atualizado',
            'email' => 'usuario_atualizado@exemplo.com',
        ];

        $response = $this->putJson('/usuarios/' . $usuario->id, $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        // Verifica se o usuário foi atualizado no banco de dados
        $this->assertDatabaseHas('usuarios', [
            'id' => $usuario->id,
            'nome' => 'Usuario Atualizado',
            'email' => 'usuario_atualizado@exemplo.com'
        ]);
    }

    public function test_can_delete_usuario()
    {
        $usuario = Usuario::factory()->create();

        $response = $this->deleteJson('/usuarios/' . $usuario->id);

        $response->assertStatus(204);

        // Verifica se o usuário foi removido do banco de dados
        $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
    }
}
