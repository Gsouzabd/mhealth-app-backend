<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\PacienteService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PacienteRequest;
use Illuminate\Validation\ValidationException;

class PacienteController extends Controller
{
    protected $service;

    public function __construct(PacienteService $service)
    {

        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/pacientes",
     *     operationId="getPacientesList",
     *     tags={"Pacientes"},
     *     summary="Listar todos os pacientes",
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
     *     path="/pacientes",
     *     operationId="storePaciente",
     *     tags={"Pacientes"},
     *     summary="Cadastrar um novo paciente",
     *     description="Cria um novo registro de paciente com os dados fornecidos.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do paciente",
     *         @OA\JsonContent(
     *             required={"nome", "cpf", "email", "data_nascimento", "sexo", "responsaveis"},
     *             @OA\Property(property="nome", type="string", example="José Silva"),
     *             @OA\Property(property="cpf", type="string", example="000.000.000-00"),
     *             @OA\Property(property="email", type="string", example="jose.silva@example.com", nullable=true),
     *             @OA\Property(property="data_nascimento", type="string", format="date", example="2000-01-01"),
     *             @OA\Property(property="sexo", type="string", example="M"),
     *             @OA\Property(property="foto", type="string", example="arquivo.jpg", nullable=true),
     *             @OA\Property(property="cep", type="string", example="00000-000", nullable=true),
     *             @OA\Property(property="endereco", type="string", example="Rua Exemplo", nullable=true),
     *             @OA\Property(property="numero", type="string", example="123", nullable=true),
     *             @OA\Property(property="complemento", type="string", example="Apto 101", nullable=true),
     *             @OA\Property(property="bairro", type="string", example="Centro", nullable=true),
     *             @OA\Property(property="cidade", type="string", example="Cidade Exemplo", nullable=true),
     *             @OA\Property(property="estado", type="string", example="Estado Exemplo", nullable=true),
     *             @OA\Property(property="telefone", type="string", example="(00) 0000-0000", nullable=true),
     *             @OA\Property(property="celular", type="string", example="(00) 90000-0000", nullable=true),
     *             @OA\Property(property="pais", type="string", example="Brasil", nullable=true),
     *             @OA\Property(property="cns", type="string", example="123 4567 8901 2345", nullable=true),
     *             @OA\Property(property="diagnostico", type="string", example="Diagnóstico do paciente", nullable=true),
            *     @OA\Property(
            *         property="responsaveis",
            *         type="array",
            *         @OA\Items(ref="#/components/schemas/Responsavel"),
            *         example={
            *             {
            *                 "nome": "João da Silva",
            *                 "cpf": "123.456.789-11",
            *                 "email": "joao@example.com",
            *                 "data_nascimento": "2000-01-01",
            *                 "sexo": "M",
            *                 "foto": "arquivo.jpg",
            *                 "cep": "00000-000",
            *                 "endereco": "Rua Exemplo",
            *                 "numero": "123",
            *                 "complemento": "Apto 101",
            *                 "bairro": "Centro",
            *                 "cidade": "Cidade Exemplo",
            *                 "estado": "Estado Exemplo",
            *                 "relacionamento": "Pai",
            *                 "responsavelFinanceiro": true
            *             },
            *             {
            *                 "nome": "Maria da Silva",
            *                 "cpf": "987.654.321-99",
            *                 "email": "maria@example.com",
            *                 "data_nascimento": "2002-03-15",
            *                 "sexo": "F",
            *                 "foto": "arquivo2.jpg",
            *                 "cep": "11111-111",
            *                 "endereco": "Rua Teste",
            *                 "numero": "456",
            *                 "complemento": "Casa",
            *                 "bairro": "Bairro Teste",
            *                 "cidade": "Cidade Teste",
            *                 "estado": "Estado Teste",
            *                 "relacionamento": "Mãe",
            *                 "responsavelFinanceiro": false
            *             }
            *         }
            *     ),
            *     @OA\Property(property="nomePai", type="string", example="João da Silva", nullable=true),
            *      @OA\Property(property="nomeMãe", type="string", example="Maria da Silva", nullable=true),
            * @OA\Property(
            *           property="convenios",
            * *      type="array",
            * *          @OA\Items(
            * *             type="integer",
             * *            example="1",
             * *         ),
             * *               @OA\Items(
             * *              type="integer",
            * *             example="1",
            * *          ),
            * *         example={1, 2},
            * *     ),
     *      ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente criado com sucesso",
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
    public function store(PacienteRequest $request)
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
     *     path="/pacientes/{id}",
     *     operationId="getPacienteById",
     *     tags={"Pacientes"},
     *     summary="Buscar paciente por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do paciente",
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
    public function show(string $id)
    {
        try {
            $paciente = $this->service->findById($id);
            return response()->json($paciente);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/pacientes/{id}",
     *     operationId="updatePaciente",
     *     tags={"Pacientes"},
     *     summary="Atualizar paciente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do paciente",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do paciente a serem alterados. Verifique os campos no Schema",
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
     *         description="Paciente não encontrado"
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
            $paciente = $this->service->update($request->all(), $id);
            return response()->json($paciente);
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
     *     path="/pacientes/{id}",
     *     operationId="deletePaciente",
     *     tags={"Pacientes"},
     *     summary="Excluir paciente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do paciente",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Paciente excluído com sucesso",
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
     *     path="/pacientes/{id}/responsaveis",
     *     operationId="getPacienteResponsaveis",
     *     tags={"Pacientes"},
     *     summary="Buscar responsáveis do paciente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do paciente",
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
    public function responsaveis(string $idPaciente)
    {
        try {
            $responsaveis = $this->service->getResponsaveis($idPaciente);
            return response()->json($responsaveis);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


}
