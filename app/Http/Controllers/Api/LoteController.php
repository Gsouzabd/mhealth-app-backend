<?php

namespace App\Http\Controllers\Api;

use App\Services\TissXmlService;
use Illuminate\Http\Request;
use App\Services\LoteService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoteRequest;
use Illuminate\Validation\ValidationException;

class LoteController extends Controller
{
    protected $service;

    protected $tissService;

    public function __construct(LoteService $service, TissXmlService $tissService)
    {
        $this->service = $service;
        $this->tissService = $tissService;
    }

    /**
     * @OA\Get(
     *     path="/lotes",
     *     operationId="getLoteList",
     *     tags={"Lotes"},
     *     summary="Listar todos as lotes",
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
     *     path="/lotes",
     *     operationId="storeLote",
     *     tags={"Lotes"},
     *     summary="Cadastrar uma nova lote",
     *     description="Cria um novo registro de lote com os dados fornecidos.",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Dados da lote",
     *      @OA\JsonContent(
     *     required={"id_convenio", "numero", "tipo", "data", "status", "valor_total"},
     * *     @OA\Property(property="id_convenio", type="integer", example="1"),
     * *     @OA\Property(property="numero", type="string", example="1"),
     * *     @OA\Property(property="tipo", type="string", example="Consulta"),
     * *     @OA\Property(property="data", type="string", format="date", example="2024-06-30"),
     * *     @OA\Property(property="status", type="string", example="0"),
     * *     @OA\Property(property="valor_total", type="number", format="decimal", example=100.00)
     * * )
     *  ),
     *     @OA\Response(
     *         response=200,
     *         description="Lote criado com sucesso",
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
    public function store(LoteRequest $request)
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
     *     path="/lotes/{id}",
     *     operationId="getLoteById",
     *     tags={"Lotes"},
     *     summary="Buscar lote por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do lote",
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
     *         description="Lote não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $lote = $this->service->findById($id);
            return response()->json($lote);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/lotes/{id}",
     *     operationId="updateLote",
     *     tags={"Lotes"},
     *     summary="Atualizar lote",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do lote",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do lote a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Lote Ilha do leite"),
     *              @OA\Property(property="endereco", type="string", example="Av. Frei Matias Teves, 280 - Ilha do Leite, Recife - PE, 50070-465")
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
     *         description="Lote não encontrado"
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
            $lote = $this->service->update($request->all(), $id);
            return response()->json($lote);
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
     *     path="/lotes/{id}",
     *     operationId="deleteLote",
     *     tags={"Lotes"},
     *     summary="Excluir lote",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do lote",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Lote excluído com sucesso",
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
     *         description="Lote não encontrado"
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
     *     path="/lotes/{idConvenio}/{numeroLote}/xml",
     *     operationId="generateXML",
     *     tags={"Lotes"},
     *     summary="Gerar XML do lote de um convênio",
     *     @OA\Parameter(
     *         name="idConvenio",
     *         in="path",
     *         description="ID do Convênio",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *          name="numeroLote",
     *          in="path",
     *          description="Número do lote atrelado ao convênio",
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
     *         description="Lote não encontrado"
     *     )
     * )
     */
    public function generateXML(int $convenioId, int $numeroLote)
    {
        try {
            $xmlLote = $this->tissService->gerarXml($numeroLote, $convenioId);

            $headers = ['Content-Type' => 'application/xml'];

            return response($xmlLote, 200, $headers);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
