<?php

namespace App\Http\Controllers;

use App\Http\Resources\VagaResource;
use App\Http\Requests\StoreVagaRequest;

use App\Models\Vaga;
use App\Models\Empresa;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/vagas",
     *     summary="Pegar todas as vagas",
     *     tags={"Vagas"},
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/VagaResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $vagas = Vaga::all();
        return VagaResource::collection($vagas);
    }

    /**
     * @OA\Post(
     *     path="/api/vagas",
     *     summary="Criar uma nova vaga",
     *     tags={"Vagas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Vaga"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vaga criada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/VagaResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisicao invalida"
     *     )
     * )
     */
    public function store(StoreVagaRequest $request)
    {
        if($this->validarSalarioHorario($request)) {
            return $this->validarSalarioHorario($request);
        }

        $empresa = Empresa::find($request->empresa_id);
        $mensagem = '';
        if($empresa->plano === 'F' && $empresa->vagas()->count() >= 5) {
            $mensagem = 'O plano Free permite até 5 vagas.';
        } else if($empresa->plano === 'P' && $empresa->vagas()->count() >= 10) {
            $mensagem = 'O plano Premium permite até 10 vagas.';
        }

        if (!empty($mensagem)) {
            $mensagem = $this->validarStringUtf8($mensagem);
            return response()->json(['error' => $mensagem], 422);
        }

        $vaga = Vaga::create($request->validated());

        return new VagaResource($vaga, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/vagas/{id}",
     *     summary="Atualizar uma vaga existente",
     *     tags={"Vagas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Vaga")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vaga atualizada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/VagaResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisicao invalida"
     *     )
     * )
     */
    public function update(StoreVagaRequest $request, Vaga $vaga)
    {
        if($this->validarSalarioHorario($request)) {
            return $this->validarSalarioHorario($request);
        }

        $vaga->update($request->validated());
        return new VagaResource($vaga, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/vagas/{id}",
     *     summary="Pegar uma vaga pelo ID",
     *     tags={"Vagas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operacao bem-sucedida",
     *         @OA\JsonContent(ref="#/components/schemas/VagaResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vaga nao encontrada"
     *     )
     * )
     */
    public function show(Vaga $vaga)
    {
        return new VagaResource($vaga);
    }

    /**
     * @OA\Delete(
     *     path="/api/vagas/{id}",
     *     summary="Deletar uma vaga pelo ID",
     *     tags={"Vagas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Vaga deletada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vaga nao encontrada"
     *     )
     * )
     */
    public function destroy(Vaga $vaga)
    {
        $vaga->delete();
        return response()->json(null, 204);
    }

    private function validarSalarioHorario(StoreVagaRequest $vaga) {
        $mensagem = '';
        if(in_array($vaga->tipo, ['CLT', 'E']) && (!$vaga->has('salario') || !$vaga->has('horario'))) {
            $mensagem = 'Salário e horário são obrigatórios para vagas do tipo CLT e Estágio.';
        }else if($vaga->tipo === 'CLT' && $vaga->salario < 1212) {
            $mensagem = 'O salário mínimo para vagas do tipo CLT é de R$ 1212,00.';
        }else if($vaga->tipo === 'E' && $vaga->horario > 6) {
            $mensagem = 'O horário máximo para vagas do tipo Estágio é de 6 horas.';
        }

        if (!empty($mensagem)) {
            $mensagem = $this->validarStringUtf8($mensagem);
            return response()->json(['error' => $mensagem], 422);
        }

        return null;
    }
}
