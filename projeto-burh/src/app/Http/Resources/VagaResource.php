<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="VagaResource",
 *     type="object",
 *     title="Retorno Vaga",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="titulo", type="string", example="Desenvolvedor Backend"),
 *     @OA\Property(property="descricao", type="string", example="Vaga para desenvolvedor backend com experiencia em Laravel"),
 *     @OA\Property(property="tipo", type="enum", example="CLT"),
 *     @OA\Property(property="salario", type="number", format="float", example=5000.00),
 *     @OA\Property(property="horario", type="integer", example=8),
 *     @OA\Property(property="empresa_id", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 * )
 */
class VagaResource extends JsonResource
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
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'tipo' => $this->tipo,
            'salario' => $this->salario,
            'horario' => $this->horario,
            'empresa_id' => $this->empresa_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
