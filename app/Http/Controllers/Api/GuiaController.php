<?php

namespace App\Http\Controllers\Api;

use App\Services\TissXmlService;
use Illuminate\Http\Request;
use App\Services\GuiaService;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuiaRequest;
use Illuminate\Validation\ValidationException;

class GuiaController extends Controller
{
    protected $service;

    public function __construct(GuiaService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/guias",
     *     operationId="getGuiaList",
     *     tags={"Guias"},
     *     summary="Listar todos as guias",
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
     *     path="/guias",
     *     operationId="storeGuia",
     *     tags={"Guias"},
     *     summary="Cadastrar uma nova guia",
     *     description="Cria um novo registro de guia com os dados fornecidos.",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Dados da guia",
     *      @OA\JsonContent(
     *      required={"lote_numero", "id_convenio", "id_paciente", "id_procedimento", "status", "data", "quantidade", "valor", "id_contratado_executante", "id_profissional_executante"},
     * *     @OA\Property(property="lote_numero", type="integer", example=1),
     * *     @OA\Property(property="id_convenio", type="integer", example=1),
     * *     @OA\Property(property="id_paciente", type="integer", example=1),
     * *     @OA\Property(property="id_procedimento", type="intenger", example="14"),
     * *     @OA\Property(property="status", type="string", example=0),
     * *     @OA\Property(property="num_guia_prestador", type="string", example="GP001"),
     * *     @OA\Property(property="num_guia_operadora", type="string", example="GO001"),
     * *     @OA\Property(property="data", type="string", format="date", example="2024-03-29"),
     * *     @OA\Property(property="quantidade", type="integer", example=1),
     * *     @OA\Property(property="valor", type="number", format="float", example=100.00),
     * *     @OA\Property(property="tabela", type="string", example="00"),
     * *     @OA\Property(property="id_contratado_executante", type="integer", example=1),
     * *     @OA\Property(property="codigo_operadora_contratado", type="string", example="COD001"),
     * *     @OA\Property(property="cnpj_contratado", type="string", example="12345678901234"),
     * *     @OA\Property(property="cnes_contratado", type="string", example="CNES001"),
     * *     @OA\Property(property="id_profissional_executante", type="integer", example=2),
     * *     @OA\Property(property="codigo_operadora_profissional", type="string", example="COD002"),
     * *     @OA\Property(property="id_conselho", type="string", example="1"),
     * *     @OA\Property(property="numero_conselho_profissional", type="string", example="08"),
     * *     @OA\Property(property="uf_conselho_profissional", type="string", example=26),
     * *     @OA\Property(property="cbo_s", type="string", example="251510"),
     * *     @OA\Property(property="tipo_consulta", type="string", example="4"),
     * *     @OA\Property(property="indicador_acidente", type="string", example="9"),
     * *     @OA\Property(property="cobertura_especial", type="string", example="02"),
     * *     @OA\Property(property="atendimento_regime", type="string", example="01"),
     * *     @OA\Property(property="observacao", type="string", example="Observações adicionais")
     * * )
     *  ),
     *     @OA\Response(
     *         response=200,
     *         description="Guia criado com sucesso",
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
    public function store(GuiaRequest $request)
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
     *     path="/guias/{id}",
     *     operationId="getGuiaById",
     *     tags={"Guias"},
     *     summary="Buscar guia por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do guia",
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
     *         description="Guia não encontrado"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $guia = $this->service->findById($id);
            return response()->json($guia);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/guias/{id}",
     *     operationId="updateGuia",
     *     tags={"Guias"},
     *     summary="Atualizar guia",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do guia",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do guia a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Guia Ilha do leite"),
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
     *         description="Guia não encontrado"
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
            $guia = $this->service->update($request->all(), $id);
            return response()->json($guia);
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
     *     path="/guias/{id}",
     *     operationId="deleteGuia",
     *     tags={"Guias"},
     *     summary="Excluir guia",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do guia",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Guia excluído com sucesso",
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
     *         description="Guia não encontrado"
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
