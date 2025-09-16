<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;

    public function criar_um_usuario()
    {
        $payload = [
            'nome' => 'Caique Oliveira',
            'email' => 'caique@gmail.com',
            'cpf' => '123.456.789-00'
        ];

        $response = $this->postJson('/api/usuarios', $payload);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => ['id', 'nome', 'email', 'cpf']
                 ]);

        $this->assertDatabaseHas('usuarios', [
            'email' => 'caique@gmail.com',
            'cpf' => '123.456.789-00'
        ]);
    }
    
    public function nao_pode_criar_usuario_com_email_repetido()
    {
        $usuario = Usuario::factory()->create([
            'email' => 'existente@gmail.com'
        ]);

        $payload = [
            'nome' => 'Novo Usuario',
            'email' => 'existente@gmail.com',
            'cpf' => '111.111.111-11'
        ];

        $response = $this->postJson('/api/usuarios', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }
    
    public function pode_deletar_um_usuario()
    {
        $usuario = Usuario::factory()->create();

        $response = $this->deleteJson("/api/usuarios/{$usuario->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
    }
}
