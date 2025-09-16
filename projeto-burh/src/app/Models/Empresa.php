<?php

namespace App\Models;

use App\Models\Vaga;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Empresa",
 *     type="object",
 *     title="Empresa",
 *     required={"nome", "descricao", "cnpj", "plano"},
 *     @OA\Property(property="nome", type="string", example="BURH"),
 *     @OA\Property(property="descricao", type="string", example="Empresa de contratacao"),
 *     @OA\Property(property="cnpj", type="string", example="12.345.678/0001-90"),
 *     @OA\Property(property="plano", type="enum", example="P"),
 * )
 */
class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'cnpj',
        'plano',
    ];

    public function vagas()
    {
        return $this->hasMany(Vaga::class);
    }
    //
}
