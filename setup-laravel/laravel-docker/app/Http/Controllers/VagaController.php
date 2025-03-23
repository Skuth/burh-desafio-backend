<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\Empresa;

class VagaController extends Controller
{
public function index()
{
    $vaga = Vaga::all(); // Exemplo de como obter todas as empresas
    
    return response()->json($vaga); // Retorna as empresas como JSON
}
public function store(Request $request)
{
    $request->validate([
        'empresa_id' => 'required|exists:empresas,id',
        'titulo' => 'required|string|max:255',
        'tipo_vaga' => 'required|in:PJ,CLT,Estagio',
        'salario' => 'nullable|numeric|min:0',
        'horario' => 'nullable|integer|min:0|max:24',
    ]);

    $empresa = Empresa::find($request->empresa_id);

    $maxVagas = $empresa->plano == 'Free' ? 5 : 10;
    if ($empresa->vagas->count() >= $maxVagas) {
        return response()->json(['error' => 'Limite de vagas atingido para o plano da empresa'], 403);
    }

    if (($request->tipo_vaga == 'CLT' && ($request->salario < 1212 || $request->salario == null || $request->horario == null)) ||
        ($request->tipo_vaga == 'Estagio' && ($request->horario == null || $request->horario > 6)) ||
        ($request->tipo_vaga == 'Estagio' && $request->salario == null)) {
        return response()->json(['error' => 'Preencha corretamente os campos de acordo com o tipo de vaga'], 422);
    }

    $vaga = Vaga::create($request->all());

    return response()->json($vaga, 201);
}

public function show(Vaga $vaga)
{
    return response()->json($vaga);
}

public function update(Request $request, Vaga $vaga)
{
    $request->validate([
        'titulo' => 'sometimes|required|string|max:255',
        'tipo_vaga' => 'sometimes|required|in:PJ,CLT,Estagio',
        'salario' => 'nullable|numeric|min:0',
        'horario' => 'nullable|integer|min:0|max:24',
    ]);

    if (($request->tipo_vaga == 'CLT' && ($request->salario < 1212 || $request->salario == null || $request->horario == null)) ||
        ($request->tipo_vaga == 'Estagio' && ($request->horario == null || $request->horario > 6)) ||
        ($request->tipo_vaga == 'Estagio' && $request->salario == null)) {
        return response()->json(['error' => 'Preencha corretamente os campos de acordo com o tipo de vaga'], 422);
    }

    $vaga->update($request->all());

    return response()->json($vaga);
}

public function destroy(Vaga $vaga)
{
    $vaga->delete();

    return response()->json(null, 204);
}

}
