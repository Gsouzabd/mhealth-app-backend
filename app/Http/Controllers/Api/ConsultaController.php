<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ConsultaService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultaRequest;
use Illuminate\Validation\ValidationException;

class ConsultaController extends Controller
{
    protected $service;

    public function __construct(ConsultaService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/consultas",
     *     operationId="getConsultaList",
     *     tags={"Consultas"},
     *     summary="Listar todas as consultas",
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não Autenticado",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Proibido",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $filters = $request->all();

        return response()
        ->json($this->service->getAll($filters), 200,
                 ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @OA\Post(
     *     path="/consultas",
     *     operationId="storeConsulta",
     *     tags={"Consultas"},
     *     summary="Cadastrar uma nova consulta",
     *     description="Cria um novo registro de consulta com os dados fornecidos.",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Dados da consulta",
     *      @OA\JsonContent(
     *          required={"dataHora", "id_funcionario", "id_especialidade", "unidadeId", "id_paciente"},
     *          @OA\Property(property="dataHora", type="string", format="date-time", example="2024-01-01T15:00:00Z"),
     *          @OA\Property(property="id_funcionario", type="string", example="1"),
     *          @OA\Property(property="id_especialidade", type="string", example="1"),
     *          @OA\Property(property="unidadeId", type="string", example="1"),
     *          @OA\Property(property="id_paciente", type="string", example="1"),
     *      ),
     *  ),
     *     @OA\Response(
     *         response=200,
     *         description="Consulta criada com sucesso",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro na requisição",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autenticado",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Proibido",
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="Erro de validação",
     *      )
     * )
     */
    public function store(ConsultaRequest $request)
    {
        try {
            $response = $this->service->create($request->all());
            return response()->json($response, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/consultas/{id}",
     *     operationId="getConsultaById",
     *     tags={"Consultas"},
     *     summary="Buscar consulta por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da consulta",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não Autenticado",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Proibido"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Consulta não encontrada"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $consulta = $this->service->findById($id);
            return response()->json($consulta);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/consultas/{id}",
     *     operationId="updateConsulta",
     *     tags={"Consultas"},
     *     summary="Atualizar consulta",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da consulta",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados da consulta a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="dataHora", type="string", format="date-time"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não Autenticado",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Proibido"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Consulta não encontrada"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        try {
            $consulta = $this->service->update($request->all(), $id);
            return response()->json($consulta);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/consultas/{id}",
     *     operationId="deleteConsulta",
     *     tags={"Consultas"},
     *     summary="Excluir consulta",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da consulta",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Consulta excluída com sucesso",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não Autenticado",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Proibido"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Consulta não encontrada"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            return response()->json($this->service->delete($id), 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}