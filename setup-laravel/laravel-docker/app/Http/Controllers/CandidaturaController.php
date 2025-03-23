<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidatura;

class CandidaturaController extends Controller
{    public function index()
    {
        $candidatura = Candidatura::all(); // Exemplo de como obter todas as empresas

        return response()->json($candidatura); // Retorna as empresas como JSON
    }
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'vaga_id' => 'required|exists:vagas,id',
            'mensagem' => 'nullable|string',
        ]);

        $candidatura = Candidatura::create($request->all());

        return response()->json($candidatura, 201);
    }

    public function show(Candidatura $candidatura)
    {
        return response()->json($candidatura);
    }

    public function update(Request $request, Candidatura $candidatura)
    {
        $request->validate([
            'usuario_id' => 'sometimes|required|exists:usuarios,id',
            'vaga_id' => 'sometimes|required|exists:vagas,id',
            'mensagem' => 'nullable|string',
        ]);

        $candidatura->update($request->all());

        return response()->json($candidatura);
    }

    public function destroy(Candidatura $candidatura)
    {
        $candidatura->delete();

        return response()->json(null, 204);
    }
}
