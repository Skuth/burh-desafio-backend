<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
public function index()
{
    $usuario = Usuario::all(); // Exemplo de como obter todas as empresas

    return response()->json($usuario); // Retorna as empresas como JSON
}
public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:usuarios,email',
        'cpf' => 'required|string|max:14|unique:usuarios,cpf',
        'idade' => 'required|integer|min:1',
    ]);

    $usuario = Usuario::create($request->all());

    return response()->json($usuario, 201);
}

public function show(Usuario $usuario)
{
    $vagas = $usuario->vagas;
    return response()->json(['usuario' => $usuario, 'vagas' => $vagas]);
}

public function update(Request $request, Usuario $usuario)
{
    $request->validate([
        'nome' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|string|email|max:255|unique:usuarios,email,' . $usuario->id,
        'cpf' => 'sometimes|required|string|max:14|unique:usuarios,cpf,' . $usuario->id,
        'idade' => 'sometimes|required|integer|min:1',
    ]);

    $usuario->update($request->all());

    return response()->json($usuario);
}

public function search(Request $request)
{
    $query = Usuario::query();

    if ($request->filled('nome')) {
        $query->where('nome', 'like', '%' . $request->nome . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', $request->email);
    }

    if ($request->filled('cpf')) {
        $query->where('cpf', $request->cpf);
    }

    $usuarios = $query->get();

    foreach ($usuarios as $usuario) {
        $usuario->vagas;
    }

    return response()->json($usuarios);
}

public function destroy(Usuario $usuario)
{
    $usuario->delete();

    return response()->json(null, 204);
}

}
