<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsuarioResource;
use App\Http\Requests\StoreUsuarioRequest;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/usuarios",
     *     summary="Pegar todos os usuarios",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UsuarioResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return UsuarioResource::collection($usuarios);
    }

    /**
     * @OA\Post(
     *     path="/api/usuarios",
     *     summary="Criar um novo usuario",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Usuario"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição invalida"
     *     )
     * )
     */
    public function store(StoreUsuarioRequest $request)
    {

        dd($request->validated());
        $usuario = Usuario::create($request->validated());

        return new UsuarioResource($usuario, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/usuarios/{id}",
     *     summary="Atualizar um usuario existente",
     *     tags={"Usuarios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Usuario")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisiçao invalida"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuario nao encontrado"
     *     )
     * )
     */
    public function update(StoreUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->validated());
        return new UsuarioResource($usuario, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/usuarios/{id}",
     *     summary="Pegar um usuario pelo ID",
     *     tags={"Usuarios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisicao invalida"
     *     )
     *     @OA\Response(
     *         response=404,
     *         description="Usuario nao encontrado"
     *     )
     * )
     */
    public function show(Usuario $usuario)
    {
        return new UsuarioResource($usuario);
    }

    /**
     * @OA\Delete(
     *     path="/api/usuarios/{id}",
     *     summary="Deletar um usuario",
     *     tags={"Usuarios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Usuario deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuario nao encontrado"
     *     )
     * )
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/usuarios/search",
     *     summary="Buscar usuarios por nome, email ou cpf",
     *     tags={"Usuarios"},
     *     @OA\Parameter(
     *         name="nome",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="cpf",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UsuarioResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisicao invalida"
     *     )
     * )
     */
    public function search(Request $request) {
        
        $query = Usuario::query();

        if($request->has('nome')) {
            $query->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        if($request->has('email')) {
            $query->where('email', 'like', '%'.$request->input('email').'%');
        }

        if($request->has('cpf')) {
            $query->where('cpf', 'like', '%'.$request->input('cpf').'%');
        }

        $usuarios = $query->get();

        return UsuarioResource::collection($usuarios);
    }

}
