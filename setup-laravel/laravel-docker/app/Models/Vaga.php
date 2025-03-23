<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descricao', 'tipo_vaga', 'empresa_id', 'salario', 'horario'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function candidatos()
    {
        return $this->belongsToMany(Usuario::class, 'candidaturas');
    }
}
