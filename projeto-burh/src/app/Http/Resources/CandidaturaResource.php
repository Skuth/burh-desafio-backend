<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidaturaResource extends JsonResource
{
    
    /**
     * @OA\Schema(
     *     schema="CandidaturaResource",
     *     type="object",
     *     title="Retorno Candidatura",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="usuario_id", type="integer", example=1),
     *     @OA\Property(property="vaga_id", type="integer", example=1),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-01T12:00:00Z"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-01T12:00:00Z")
     * )
     */
    public function toArray(Request $request): array
    {
        return [ 
            'id' => $this->id,
            'vaga_id' => $this->vaga_id,
            'usuario_id' => $this->usuario_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
