<?php

namespace App\Models;

use App\Models\VagaResource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Usuario",
 *     type="object",
 *     title="Usuario",
 *     required={"nome", "email", "cpf"},
 *     @OA\Property(property="nome", type="string", example="Caique Oliveira"),
 *     @OA\Property(property="email", type="string", example="caique@gmail.com"),
 *     @OA\Property(property="cpf", type="string", example="123.456.789-00"),
 *     @OA\Property(property="data_nascimento", type="string", format="date", example="1990-01-01"),
 * )
 */
class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'data_nascimento',
    ];

    public function idade() {
        $dataNascimento = new \DateTime($this->data_nascimento);
        $dataAtual = new \DateTime();
        $idade = $dataAtual->diff($dataNascimento)->y;
        return $idade;
    }
    
    public function vagasCandidatas() {
        return $this->belongsToMany(Vaga::class, 'candidaturas', 'usuario_id', 'vaga_id')->get();
    }
}
