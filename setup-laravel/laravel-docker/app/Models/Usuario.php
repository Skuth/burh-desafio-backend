<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'cpf','senha','idade'];

    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class);
    }

public function vagas()
    {
        return $this->belongsToMany(Vaga::class, 'candidaturas');
    }
}
