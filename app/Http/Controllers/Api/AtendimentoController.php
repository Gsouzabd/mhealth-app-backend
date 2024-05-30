<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AtendimentoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AtendimentoRequest;
use Illuminate\Validation\ValidationException;

class AtendimentoController extends Controller
{
    protected $service;

    public function __construct(AtendimentoService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/atendimentos",
     *     operationId="getAtendimentoList",
     *     tags={"Atendimentos"},
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
     * @OA\Get(
     *     path="/atendimentos/{id}",
     *     operationId="getAtendimentoById",
     *     tags={"Atendimentos"},
     *     summary="Buscar atendimento por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da atendimento",
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
            $atendimento = $this->service->findById($id);
            return response()->json($atendimento);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/atendimentos/{id}",
     *     operationId="updateAtendimento",
     *     tags={"Atendimentos"},
     *     summary="Atualizar atendimento",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da atendimento",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do atendimento a serem alterados. Verifique os campos no Schema",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="em andamento")
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
            $atendimento = $this->service->update($request->all(), $id);
            return response()->json($atendimento);
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
     *     path="/atendimentos/{id}",
     *     operationId="deleteAtendimento",
     *     tags={"Atendimentos"},
     *     summary="Excluir atendimento",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da atendimento",
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


}
