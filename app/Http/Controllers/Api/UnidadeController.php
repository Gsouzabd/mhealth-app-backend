<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UnidadeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnidadeRequest;
use Illuminate\Validation\ValidationException;

class UnidadeController extends Controller
{
    protected $service;

    public function __construct(UnidadeService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/unidades",
     *     operationId="getUnidadeList",
     *     tags={"Unidades"},
     *     summary="Listar todos os unidades",
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
     *     path="/unidades",
     *     operationId="storeUnidade",
     *     tags={"Unidades"},
     *     summary="Cadastrar um novo unidade",
     *     description="Cria um novo registro de unidade com os dados fornecidos.",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Dados do unidade",
     *      @OA\JsonContent(
     *          required={"nome", "endereco"},
     * *          @OA\Property(property="nome", type="string", example="Unidade Ilha do leite"),
     * *          @OA\Property(property="endereco", type="string", example="Av. Frei Matias Teves, 280 - Ilha do Leite, Recife - PE, 50070-465"),
     * *         ),
     *  ),
     *     @OA\Response(
     *         response=200,
     *         description="Unidade criado com sucesso",
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
    public function store(UnidadeRequest $request)
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
     *     path="/unidades/{id}",
     *     operationId="getUnidadeById",
     *     tags={"Unidades"},
     *     summary="Buscar unidade por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do unidade",
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
     *         description="Unidade não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $unidade = $this->service->findById($id);
            return response()->json($unidade);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/unidades/{id}",
     *     operationId="updateUnidade",
     *     tags={"Unidades"},
     *     summary="Atualizar unidade",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do unidade",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do unidade a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Unidade Ilha do leite"),
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
     *         description="Unidade não encontrado"
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
            $unidade = $this->service->update($request->all(), $id);
            return response()->json($unidade);
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
     *     path="/unidades/{id}",
     *     operationId="deleteUnidade",
     *     tags={"Unidades"},
     *     summary="Excluir unidade",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do unidade",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Unidade excluído com sucesso",
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
     *         description="Unidade não encontrado"
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
