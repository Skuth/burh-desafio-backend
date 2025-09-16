<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Candidatura",
 *     type="object",
 *     title="Candidatura",
 *     required={"usuario_id", "vaga_id"},
 *     @OA\Property(property="usuario_id", type="integer", example=1),
 *     @OA\Property(property="vaga_id", type="integer", example=1)
 * )
 */
class Candidatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'vaga_id',
    ];
    //
}
