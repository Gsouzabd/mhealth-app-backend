<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AdministradorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdministradorRequest;
use Illuminate\Validation\ValidationException;

class AdministradorController extends Controller
{
    protected $service;

    public function __construct(AdministradorService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/administradores",
     *     operationId="getAdministradorList",
     *     tags={"Administradores"},
     *     summary="Listar todos os administradores",
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
     *     path="/administradores",
     *     operationId="storeAdministrador",
     *     tags={"Administradores"},
     *     summary="Cadastrar um novo administrador",
     *     description="Cria um novo registro de administrador com os dados fornecidos.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do administrador",
     *         @OA\JsonContent(
     *             required={"nome", "cpf", "email", "password", "data_nascimento", "sexo"},
     *                  @OA\Property(property="nome", type="string", example="João da Silva"),
     *                  @OA\Property(property="cpf", type="string", example="123.456.789-11"),
     *                  @OA\Property(property="email", type="string", example="joao123@example.com"),
     *                  @OA\Property(property="password", type="string", example="senha@123"),
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
     *                  @OA\Property(property="telefone", type="string", example="(00) 0000-0000", nullable=true),
     *                  @OA\Property(property="celular", type="string", example="(00) 90000-0000", nullable=true),
     *                  @OA\Property(property="pais", type="string", example="Brasil", nullable=true),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Administrador criado com sucesso",
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
    public function store(AdministradorRequest $request)
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
     *     path="/administradores/{id}",
     *     operationId="getAdministradorById",
     *     tags={"Administradores"},
     *     summary="Buscar administrador por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do administrador",
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
     *         description="Administrador não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $administrador = $this->service->findById($id);
            return response()->json($administrador);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/administradores/{id}",
     *     operationId="updateAdministrador",
     *     tags={"Administradores"},
     *     summary="Atualizar administrador",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do administrador",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do administrador a serem alterados. Verifique os campos no Schema",
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
     *         description="Administrador não encontrado"
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
            $administrador = $this->service->update($request->all(), $id);
            return response()->json($administrador);
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
     *     path="/administradores/{id}",
     *     operationId="deleteAdministrador",
     *     tags={"Administradores"},
     *     summary="Excluir administrador",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do administrador",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Administrador excluído com sucesso",
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
     *         description="Administrador não encontrado"
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
