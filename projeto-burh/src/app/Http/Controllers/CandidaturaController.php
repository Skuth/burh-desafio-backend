<?php

namespace App\Http\Controllers;

use App\Http\Resources\CandidaturaResource;
use App\Http\Requests\StoreCandidaturaRequest;

use App\Models\Candidatura;
use Illuminate\Http\Request;

class CandidaturaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/candidaturas",
     *     summary="Pegar todas as candidaturas",
     *     tags={"Candidaturas"},
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CandidaturaResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $candidaturas = Candidatura::all();
        return CandidaturaResource::collection($candidaturas);
    }

    /**
     * @OA\Post(
     *     path="/api/candidaturas",
     *     summary="Criar uma nova candidatura",
     *     tags={"Candidaturas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Candidatura")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Candidatura criada",
     *         @OA\JsonContent(ref="#/components/schemas/CandidaturaResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *     )
     * )
     */
    public function store(StoreCandidaturaRequest $request)
    {
        $candidatura = Candidatura::create($request->validated());
        return new CandidaturaResource($candidatura, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/candidaturas/{id}",
     *     summary="Pegar uma candidatura pelo ID",
     *     tags={"Candidaturas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/CandidaturaResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Candidatura nao encontrada",
     *     )
     * )
     */
    public function show(Candidatura $candidatura)
    {
        return new CandidaturaResource($candidatura);
    }

    /**
     * @OA\Put(
     *     path="/api/candidaturas/{id}",
     *     summary="Atualizar uma candidatura existente",
     *     tags={"Candidaturas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Candidatura")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Candidatura atualizada",
     *         @OA\JsonContent(ref="#/components/schemas/CandidaturaResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Candidatura nao encontrada",
     *     )
     * )
     */
    public function update(StoreCandidaturaRequest $request, Candidatura $candidatura)
    {
        $candidatura->update($request->validated());
        return new CandidaturaResource($candidatura, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/candidaturas/{id}",
     *     summary="Deletar uma candidatura",
     *     tags={"Candidaturas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Candidatura deletada",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Candidatura nao encontrada",
     *     )
     * )
     */
    public function destroy(Candidatura $candidatura)
    {
        $candidatura->delete();
        return response()->json(null, 204);
    }
}
