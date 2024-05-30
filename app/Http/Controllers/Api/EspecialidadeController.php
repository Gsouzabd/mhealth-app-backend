<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\EspecialidadeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EspecialidadeRequest;
use Illuminate\Validation\ValidationException;

class EspecialidadeController extends Controller
{
    protected $service;

    public function __construct(EspecialidadeService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/especialidades",
     *     operationId="getEspecialidadeList",
     *     tags={"Especialidades"},
     *     summary="Listar todos os especialidades",
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
     *     path="/especialidades",
     *     operationId="storeEspecialidade",
     *     tags={"Especialidades"},
     *     summary="Cadastrar um novo especialidade",
     *     description="Cria um novo registro de especialidade com os dados fornecidos.",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Dados do especialidade",
     *      @OA\JsonContent(
     *             required={"nome", "cbos"},
     * *          @OA\Property(property="nome", type="string", example="Psicologia"),
     * *          @OA\Property(property="descricao", type="string", example="Descrição da especialidade"),
     * *          @OA\Property(property="cbos", type="string", example="2515-10"),
     *      ),
     *  ),
     *     @OA\Response(
     *         response=200,
     *         description="Especialidade criado com sucesso",
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
    public function store(EspecialidadeRequest $request)
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
     *     path="/especialidades/{id}",
     *     operationId="getEspecialidadeById",
     *     tags={"Especialidades"},
     *     summary="Buscar especialidade por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do especialidade",
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
     *         description="Especialidade não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $especialidade = $this->service->findById($id);
            return response()->json($especialidade);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/especialidades/{id}",
     *     operationId="updateEspecialidade",
     *     tags={"Especialidades"},
     *     summary="Atualizar especialidade",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do especialidade",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do especialidade a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Psicologia")
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
     *         description="Especialidade não encontrado"
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
            $especialidade = $this->service->update($request->all(), $id);
            return response()->json($especialidade);
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
     *     path="/especialidades/{id}",
     *     operationId="deleteEspecialidade",
     *     tags={"Especialidades"},
     *     summary="Excluir especialidade",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do especialidade",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Especialidade excluído com sucesso",
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
     *         description="Especialidade não encontrado"
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
