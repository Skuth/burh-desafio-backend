<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmpresaResource;
use App\Http\Requests\StoreEmpresaRequest;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/empresas",
     *     summary="Pegar todas as empresas",
     *     tags={"Empresas"},
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/EmpresaResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $empresas = Empresa::all();
        return EmpresaResource::collection($empresas);
    }

    /**
     * @OA\Post(
     *     path="/api/empresas",
     *     summary="Criar uma nova empresa",
     *     tags={"Empresas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Empresa")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Empresa criada",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *     )
     * )
     */
    public function store(StoreEmpresaRequest $request)
    {
        $empresa = Empresa::create($request->validated());
        return new EmpresaResource($empresa, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/empresas/{id}",
     *     summary="Pegar uma empresa por ID",
     *     tags={"Empresas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/EmpresaResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Empresa nao encontrada"
     *     )
     * )
     */
    public function show(Empresa $empresa)
    {
        return new EmpresaResource($empresa);
    }

    /**
     * @OA\Put(
     *     path="/api/empresas/{id}",
     *     summary="Atualizar uma empresa existente",
     *     tags={"Empresas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Empresa")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Empresa atualizada",
     *         @OA\JsonContent(ref="#/components/schemas/EmpresaResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Empresa nao encontrada"
     *     )
     * )
     */
    public function update(StoreEmpresaRequest $request, Empresa $empresa)
    {
        $empresa->update($request->validated());
        return new EmpresaResource($empresa, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/empresas/{id}",
     *     summary="Deletar uma empresa",
     *     tags={"Empresas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Empresa deletada",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Empresa nao encontrada"
     *     )
     * )
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return response()->json(null, 204);
    }
}
