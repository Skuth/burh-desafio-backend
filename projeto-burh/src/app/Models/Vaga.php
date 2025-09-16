<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Vaga",
 *     type="object",
 *     title="Vaga",
 *     required={"titulo", "descricao", "tipo", "salario", "horario", "empresa_id"},
 *     @OA\Property(property="titulo", type="string", example="Desenvolvedor Backend"),
 *     @OA\Property(property="descricao", type="string", example="Vaga para desenvolvedor backend com experiencia em Laravel"),
 *     @OA\Property(property="tipo", type="enum", example="CLT"),
 *     @OA\Property(property="salario", type="number", format="float", example=5000.00),
 *     @OA\Property(property="horario", type="integer", example=8),
 *     @OA\Property(property="empresa_id", type="integer", example=1)
 * )
 */
class Vaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'titulo',
        'descricao',
        'tipo',
        'salario',
        'horario'
    ];
    //
}
