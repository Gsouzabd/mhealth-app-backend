<?php

namespace App\Http\Controllers\Api;

use App\Models\Configuracao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConfiguracaoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/configuracoes",
     *     operationId="getConfigs",
     *     tags={"Configuraçoes"},
     *     summary="Listar ultimas configs",
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
    public function index()
    {
        $configuracoes = Configuracao::latest()->first();
        return response()->json($configuracoes);
    }

    /**
     * @OA\Post(
     *     path="/configuracoes",
     *     operationId="storeConfiguracao",
     *     tags={"Configuraçoes"},
     *     summary="Cadastrar uma novo configuração",
     *     description="Cria um novo registro de configuração com os dados fornecidos.",
     *  @OA\RequestBody(
     *      required=true,
     *      description="Dados da configuração",
     *      @OA\JsonContent(
    *   @OA\Property(property="logo", type="string", example="data:@file/png;base64..."),
    *   @OA\Property(property="nome_empresa", type="string", example="Nome da Empresa"),
    *   @OA\Property(property="telefone", type="string", example="+5511999999999"),
    *   @OA\Property(property="titulo", type="string", example="Título da Empresa"),
    *   @OA\Property(property="descricao", type="string", example="Descrição da Empresa"),
    *   @OA\Property(property="textoFooter", type="string", example="Texto do rodapé da Empresa"),
    *   @OA\Property(property="banner_app", type="string", example="data:@file/png;base64..."),
    *   @OA\Property(property="banner_site", type="string", example="data:@file/png;base64..."),
    *   @OA\Property(property="banner_site_mobile", type="string", example="data:@file/png;base64..."),
    *   @OA\Property(property="segunda_sexta", type="boolean", example=true),
    *   @OA\Property(property="segunda_sexta_horario_inicio", type="string", example="08:00"),
    *   @OA\Property(property="segunda_sexta_horario_fim", type="string", example="18:00"),
    *   @OA\Property(property="sabado_domingo", type="boolean", example=true),
    *   @OA\Property(property="sabado_domingo_horario_inicio", type="string", example="08:00"),
    *   @OA\Property(property="sabado_domingo_horario_fim", type="string", example="18:00"),
     *      ),
     *  ),
     *     @OA\Response(
     *         response=200,
     *         description="configuração criado com sucesso",
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
    public function store(Request $request)
    {
        $data = $request->except(['logo', 'banner_app', 'banner_site', 'banner_site_mobile']);

        if ($request->has('logo')) {
            $data['logo'] = $this->saveBase64Image($request->logo, 'logos');
        }

        if ($request->has('banner_app')) {
            $data['banner_app'] = $this->saveBase64Image($request->banner_app, 'banners/app');
        }

        if ($request->has('banner_site')) {
            $data['banner_site'] = $this->saveBase64Image($request->banner_site, 'banners/site');
        }

        if ($request->has('banner_site_mobile')) {
            $data['banner_site_mobile'] = $this->saveBase64Image($request->banner_site_mobile, 'banners/site_mobile');
        }

        $configuracao = Configuracao::create($data);

        return response()->json($configuracao, 201);
    }



    public function show($id)
    {
        $configuracao = Configuracao::find($id);
        if (!$configuracao) {
            return response()->json(['error' => 'Configuração not found.'], 404);
        }
        return response()->json($configuracao);
    }

    public function update(Request $request, $id)
    {
        $configuracao = Configuracao::find($id);
        if (!$configuracao) {
            return response()->json(['error' => 'Configuração not found.'], 404);
        }
        $configuracao->update($request->all());
        return response()->json($configuracao);
    }

    public function destroy($id)
    {
        $configuracao = Configuracao::find($id);
        if (!$configuracao) {
            return response()->json(['error' => 'Configuração not found.'], 404);
        }
        $configuracao->delete();
        return response()->json(['success' => 'Configuração deleted successfully.'], 200);
    }




    /**
     * Decode a base64 encoded image and save it to storage.
     *
     * @param string $base64Image Base64 encoded image
     * @param string $path Path within storage to save the image
     * @return string Path to the saved image file
     */
    protected function saveBase64Image($base64Image, $path)
    {
        // Decode the base64 string
        $imageData = base64_decode(preg_replace('#^data:(image/\w+|@file/\w+);base64,#i', '', $base64Image));        
        // Create a unique filename for the image
        $fileName = uniqid() . '.png';

        // Save the decoded image to storage
        Storage::disk('public')->put("{$path}/{$fileName}", $imageData);

        // Return the path to the saved image
        return "storage/{$path}/{$fileName}";
    }
}