<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ConvenioService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConvenioRequest;
use Illuminate\Validation\ValidationException;

class ConvenioController extends Controller
{
    protected $service;

    public function __construct(ConvenioService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/convenios",
     *     operationId="getConvenioList",
     *     tags={"Convênios"},
     *     summary="Listar todos os convenios",
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
     *     path="/convenios",
     *     operationId="storeConvenio",
     *     tags={"Convênios"},
     *     summary="Cadastrar um novo convenio",
     *     description="Cria um novo registro de convenio com os dados fornecidos.",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Dados do convenio",
     *      @OA\JsonContent(
     *          required={"nome"},
     *          @OA\Property(property="nome", type="string", example="Nome do Convenio"),
     *          @OA\Property(property="diasCarencia", type="integer", example=30),
     *          @OA\Property(property="geraReceitas", type="boolean", example=true),
     *          @OA\Property(property="numeroderegistro", type="string", example="xxxxxx"),
     *          @OA\Property(property="codigonaoperadora", type="string", example=null),
     *          @OA\Property(property="versaoxml", type="string", example=""),
     *          @OA\Property(property="tabela", type="string", example="00"),
     *          @OA\Property(property="maxSessoesTiss", type="integer", example=100),
     *      ),
     *  ),
     *     @OA\Response(
     *         response=200,
     *         description="Convenio criado com sucesso",
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
    public function store(ConvenioRequest $request)
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
     *     path="/convenios/{id}",
     *     operationId="getConvenioById",
     *     tags={"Convênios"},
     *     summary="Buscar convenio por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do convenio",
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
     *         description="Convenio não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $convenio = $this->service->findById($id);
            return response()->json($convenio);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/convenios/{id}",
     *     operationId="updateConvenio",
     *     tags={"Convênios"},
     *     summary="Atualizar convenio",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do convenio",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do convenio a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Amil")
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
     *         description="Convenio não encontrado"
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
            $convenio = $this->service->update($request->all(), $id);
            return response()->json($convenio);
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
     *     path="/convenios/{id}",
     *     operationId="deleteConvenio",
     *     tags={"Convênios"},
     *     summary="Excluir convenio",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do convenio",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Convenio excluído com sucesso",
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
     *         description="Convenio não encontrado"
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
