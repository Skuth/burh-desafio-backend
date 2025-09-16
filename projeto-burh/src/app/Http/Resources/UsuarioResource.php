<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="UsuarioResource",
 *     type="object",
 *     title="Retorno Usuario",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nome", type="string", example="Caique"),
 *     @OA\Property(property="email", type="string", example="caique@gmail.com"),
 *     @OA\Property(property="cpf", type="string", example="123.456.789-00"),
 *     @OA\Property(property="data_nascimento", type="string", format="date", example="1990-01-01"),
 *     @OA\Property(property="idade", type="integer", example=34),
 *     @OA\Property(property="vagas_candidatas", type="array",
 *         @OA\Items(type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="titulo", type="string", example="Desenvolvedor Backend"),
 *             @OA\Property(property="descricao", type="string", example="Vaga para desenvolvedor backend com experiencia em Laravel"),
 *             @OA\Property(property="salario", type="number", format="float", example=5000.00),
 *             @OA\Property(property="tipo", type="string", example="CLT"),
 *             @OA\Property(property="horario", type="integer", example=8),
 *             @OA\Property(property="empresa_id", type="integer", example=1),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 *        )
 *     ),
 *    @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 *    @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 * )
 */
class UsuarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'idade' => $this->idade(),
            'vagas_candidatas' => $this->vagasCandidatas(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
