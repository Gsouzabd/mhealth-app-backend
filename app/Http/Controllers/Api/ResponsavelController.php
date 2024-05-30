<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ResponsavelService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResponsavelRequest;
use Illuminate\Validation\ValidationException;

class ResponsavelController extends Controller
{
    protected $service;

    public function __construct(ResponsavelService $service)
    {

        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/responsaveis",
     *     operationId="getResponsavelList",
     *     tags={"Responsáveis"},
     *     summary="Listar todos os responsáveis",
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
     *     path="/responsaveis",
     *     operationId="storeResponsavel",
     *     tags={"Responsáveis"},
     *     summary="Cadastrar um novo responsavel",
     *     description="Cria um novo registro de responsavel com os dados fornecidos.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do responsavel",
     *         @OA\JsonContent(
     *             required={"nome", "cpf", "email", "data_nascimento", "sexo"},
     *                  @OA\Property(property="nome", type="string", example="João da Silva"),
     *                  @OA\Property(property="cpf", type="string", example="123.456.789-11"),
     *                  @OA\Property(property="email", type="string", example="joao123@example.com"),
     *                  @OA\Property(property="data_nascimento", type="string", format="date", example="2000-01-01"),
     *                  @OA\Property(property="sexo", type="string", example="M"),
     *                  @OA\Property(property="foto", type="string", example="arquivo.jpg", nullable=true),
     *                  @OA\Property(property="cep", type="string", example="00000-000", nullable=true),
     *                  @OA\Property(property="endereco", type="string", example="Rua Exemplo", nullable=true),
     *                  @OA\Property(property="numero", type="string", example="123", nullable=true),
     *                  @OA\Property(property="complemento", type="string", example="Apto 101", nullable=true),
     *                  @OA\Property(property="bairro", type="string", example="Centro", nullable=true),
     *                  @OA\Property(property="cidade", type="string", example="Cidade Exemplo", nullable=true),
     *                  @OA\Property(property="estado", type="string", example="Estado Exemplo", nullable=true),
     *                  @OA\Property(property="paciente_id", type="intenger", example="1", nullable=true),
    *                  @OA\Property(property="parentesco", type="string", example="Pai", nullable=true),
    *                  @OA\Property(property="relacionamento", type="string", example="Responsavel", nullable=true),
     *                  @OA\Property(property="responsavelFinanceiro", type="boolean", example="true"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Responsavel criado com sucesso",
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
    public function store(ResponsavelRequest $request)
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
     *     path="/responsaveis/{id}",
     *     operationId="getResponsavelById",
     *     tags={"Responsáveis"},
     *     summary="Buscar responsavel por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do responsavel",
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
     *         description="Responsavel não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $responsavel = $this->service->findById($id);
            return response()->json($responsavel);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/responsaveis/{id}",
     *     operationId="updateResponsavel",
     *     tags={"Responsáveis"},
     *     summary="Atualizar responsavel",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do responsavel",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do responsavel a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="José Silva")
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
     *         description="Responsavel não encontrado"
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
            $responsavel = $this->service->update($request->all(), $id);
            return response()->json($responsavel);
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
     *     path="/responsaveis/{id}",
     *     operationId="deleteResponsavel",
     *     tags={"Responsáveis"},
     *     summary="Excluir responsavel",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do responsavel",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Responsavel excluído com sucesso",
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
     *         description="Responsavel não encontrado"
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
