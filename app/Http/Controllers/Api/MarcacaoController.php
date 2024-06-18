<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\MarcacaoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarcacaoRequest;
use Illuminate\Validation\ValidationException;

class MarcacaoController extends Controller
{
    protected $service;

    public function __construct(MarcacaoService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/marcacoes",
     *     operationId="getMarcacaoList",
     *     tags={"Marcações"},
     *     summary="Listar todas as marcações",
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
     *     path="/marcacoes",
     *     operationId="storeMarcacao",
     *     tags={"Marcações"},
     *     summary="Cadastrar uma nova marcação",
     *     description="Cria um novo registro de marcação com os dados fornecidos.",
     *     @OA\RequestBody(
         *      required=true,
         *      description="Dados do marcacao",
         *      @OA\JsonContent(
         *       required={"id_paciente", "id_funcionario", "id_especialidade", "convenio", "duracao", "horario", "data_inicial", "recorrencia", "marcadoPor", "unidade"},
         * *     @OA\Property(property="id_paciente", type="integer", example=1),
         * *     @OA\Property(property="id_funcionario", type="integer", example=2),
         * *     @OA\Property(property="id_especialidade", type="integer", example=3),
         * *     @OA\Property(property="convenio", type="integer", example=1),
         * *     @OA\Property(property="duracao", type="integer", example=60),
         * *     @OA\Property(property="horario", type="string", format="hour", example="14:00:00"),
         * *     @OA\Property(property="data_inicial", type="string", format="date", example="2024-03-18"),
         * *     @OA\Property(property="recorrencia", type="boolean", example=false),
         * *     @OA\Property(property="vezesRecorrencia", type="integer", example=4),
         * *     @OA\Property(property="marcadoPor", type="integer", example=1),
         * *     @OA\Property(property="unidade", type="integer", example=1)
         * *  )
     *    ),
     *     @OA\Response(
     *         response=200,
     *         description="Marcacao criado com sucesso",
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
    public function store(MarcacaoRequest $request)
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
     *     path="/marcacoes/{id}",
     *     operationId="getMarcacaoById",
     *     tags={"Marcações"},
     *     summary="Buscar marcação por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da marcação",
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
     *         description="Marcação não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $marcacao = $this->service->findById($id);
            return response()->json($marcacao);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/marcacoes/{id}",
     *     operationId="updateMarcacao",
     *     tags={"Marcações"},
     *     summary="Atualizar marcação",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da marcação",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do marcacao a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="duraca", type="integer", example="30")
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
     *         description="Marcação não encontrado"
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
            $marcacao = $this->service->update($request->all(), $id);
            return response()->json($marcacao);
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
     *     path="/marcacoes/{id}",
     *     operationId="deleteMarcacao",
     *     tags={"Marcações"},
     *     summary="Excluir marcação",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da marcação",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Marcação excluído com sucesso",
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
     *         description="Marcação não encontrado"
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

    /**
     * @OA\Get(
     *     path="/marcacoes/{idMarcacao}/atendimentos",
     *     operationId="getMarcacaoAtendimentos",
     *     tags={"Marcações","Atendimentos"},
     *     summary="Buscar atendimentos por marcação",
     *     @OA\Parameter(
     *         name="idMarcacao",
     *         in="path",
     *         description="ID da marcação",
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
     *         description="Paciente não encontrado"
     *     )
     * )
     */
    public function atendimentos(string $idMarcacao)
    {
        try{
            $atendimentos = $this->service->getAtendimentos($idMarcacao);

            return response()->json($atendimentos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

    }

    /**
     * @OA\Get(
     *     path="/marcacoes/{idMarcacao}/atendimentos/{idAtendimento}",
     *     operationId="getMarcacaoAtendimentoById",
     *     tags={"Marcações","Atendimentos"},
     *     summary="Buscar atendimento by id por marcação",
     *     @OA\Parameter(
     *         name="idMarcacao",
     *         in="path",
     *         description="ID da marcação",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *          name="idAtendimento",
     *          in="path",
     *          description="ID do atendimento",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
     *         description="Paciente não encontrado"
     *     )
     * )
     */
    public function atendimentoById(string $idMarcacao, string $idAtendimento)
    {
        try{
            $atendimentos = $this->service->getAtendimentoById($idMarcacao, $idAtendimento);

            return response()->json($atendimentos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

    }

}
