<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa; 

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all(); // Exemplo de como obter todas as empresas

        return response()->json($empresas); // Retorna as empresas como JSON
    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14|unique:empresas,cnpj',
            'plano' => 'required|in:Free,Premium',
        ]);
    
        $empresa = Empresa::create($request->all());
    
        return response()->json($empresa, 201);
    }
    
    public function show(Empresa $empresa)
    {
        return response()->json($empresa);
    }
    
    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'cnpj' => 'sometimes|required|string|max:14|unique:empresas,cnpj,' . $empresa->id,
            'plano' => 'sometimes|required|in:Free,Premium',
        ]);
    
        $empresa->update($request->all());
    
        return response()->json($empresa);
    }
    
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
    
        return response()->json(null, 204);
    }
}
