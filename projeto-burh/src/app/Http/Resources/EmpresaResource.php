<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="EmpresaResource",
 *     type="object",
 *     title="Retorno Empresa",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nome", type="string", example="BURH"),
 *     @OA\Property(property="descricao", type="string", example="Empresa de contratacao"),
 *     @OA\Property(property="cnpj", type="string", example="12.345.678/0001-90"),
 *     @OA\Property(property="plano", type="enum", example="P"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
 * )
 */
class EmpresaResource extends JsonResource
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
            'descricao' => $this->descricao,
            'cnpj' => $this->cnpj,
            'plano' => $this->plano,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
