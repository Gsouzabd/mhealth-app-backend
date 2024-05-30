<?php

namespace App\Helpers;
class HelpersTiss{
    /**
     * @OA\Get(
     *     path="/helpers/tiss/",
     *     operationId="getAllHelpersTiss",
     *     tags={"HelpersTiss"},
     *     summary="Listar informações de todas as tabelas TISS combinadas",
     *     description="Retorna uma lista combinada de informações de todas as tabelas TISS, incluindo UF, tabelas, tipos de consulta, regimes de atendimento, coberturas especiais e indicações de acidente.",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="uf",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="codigo_uf", type="string", example="11"),
     *                     @OA\Property(property="uf", type="string", example="Rondônia"),
     *                     @OA\Property(property="unidade_federacao", type="string", example="RO")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="tabela",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="codigo", type="string", example="00"),
     *                     @OA\Property(property="titulo", type="string", example="Tabela própria das operadoras")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="tipo_consulta",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="codigo", type="string", example="1"),
     *                     @OA\Property(property="titulo", type="string", example="Primeira Consulta")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="regime_atendimento",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="codigo", type="string", example="1"),
     *                     @OA\Property(property="titulo", type="string", example="Ambulatorial")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="cobertura_especial",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="codigo", type="string", example="01"),
     *                     @OA\Property(property="titulo", type="string", example="Gestante")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="indicacao_acidente",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="codigo", type="string", example="0"),
     *                     @OA\Property(property="titulo", type="string", example="Trabalho")
     *                 )
     *             )
     *         )
     *     ),
     * )
     */
    public static function getAll()
    {
        return [
            "uf" => self::getUfs(),
            "tabela" => self::getTabela(),
            "tipo_consulta" => self::getTipoConsulta(),
            "regime_atendimento" => self::getRegimeAtendimento(),
            "cobertura_especial" => self::getCoberturaEspecial(),
            "indicacao_acidente" => self::getIndicacaoAcidente(),
        ];
    }

    public static function getUfs()
    {
        $ufs = [
            ['codigo_uf' => '11', 'uf' => 'Rondônia', 'unidade_federacao' => 'RO'],
            ['codigo_uf' => '12', 'uf' => 'Acre', 'unidade_federacao' => 'AC'],
            ['codigo_uf' => '13', 'uf' => 'Amazonas', 'unidade_federacao' => 'AM'],
            ['codigo_uf' => '14', 'uf' => 'Roraima', 'unidade_federacao' => 'RR'],
            ['codigo_uf' => '15', 'uf' => 'Pará', 'unidade_federacao' => 'PA'],
            ['codigo_uf' => '16', 'uf' => 'Amapá', 'unidade_federacao' => 'AP'],
            ['codigo_uf' => '17', 'uf' => 'Tocantins', 'unidade_federacao' => 'TO'],
            ['codigo_uf' => '21', 'uf' => 'Maranhão', 'unidade_federacao' => 'MA'],
            ['codigo_uf' => '22', 'uf' => 'Piauí', 'unidade_federacao' => 'PI'],
            ['codigo_uf' => '23', 'uf' => 'Ceará', 'unidade_federacao' => 'CE'],
            ['codigo_uf' => '24', 'uf' => 'Rio Grande do Norte', 'unidade_federacao' => 'RN'],
            ['codigo_uf' => '25', 'uf' => 'Paraíba', 'unidade_federacao' => 'PB'],
            ['codigo_uf' => '26', 'uf' => 'Pernambuco', 'unidade_federacao' => 'PE'],
            ['codigo_uf' => '27', 'uf' => 'Alagoas', 'unidade_federacao' => 'AL'],
            ['codigo_uf' => '28', 'uf' => 'Sergipe', 'unidade_federacao' => 'SE'],
            ['codigo_uf' => '29', 'uf' => 'Bahia', 'unidade_federacao' => 'BA'],
            ['codigo_uf' => '31', 'uf' => 'Minas Gerais', 'unidade_federacao' => 'MG'],
            ['codigo_uf' => '32', 'uf' => 'Espírito Santo', 'unidade_federacao' => 'ES'],
            ['codigo_uf' => '33', 'uf' => 'Rio de Janeiro', 'unidade_federacao' => 'RJ'],
            ['codigo_uf' => '35', 'uf' => 'São Paulo', 'unidade_federacao' => 'SP'],
            ['codigo_uf' => '41', 'uf' => 'Paraná', 'unidade_federacao' => 'PR'],
            ['codigo_uf' => '42', 'uf' => 'Santa Catarina', 'unidade_federacao' => 'SC'],
            ['codigo_uf' => '43', 'uf' => 'Rio Grande do Sul (*)', 'unidade_federacao' => 'RS'],
            ['codigo_uf' => '50', 'uf' => 'Mato Grosso do Sul', 'unidade_federacao' => 'MS'],
            ['codigo_uf' => '51', 'uf' => 'Mato Grosso', 'unidade_federacao' => 'MT'],
            ['codigo_uf' => '52', 'uf' => 'Goiás', 'unidade_federacao' => 'GO'],
            ['codigo_uf' => '53', 'uf' => 'Distrito Federal', 'unidade_federacao' => 'DF'],
        ];

        usort($ufs, function ($a, $b) {
            return strcmp($a['unidade_federacao'], $b['unidade_federacao']);
        });

        return $ufs;
    }

    public static function getTabela()
    {
        return [
            ['codigo' => '00', 'titulo' => 'Tabela própria das operadoras'],
            ['codigo' => '18', 'titulo' => 'Diárias, taxas e gases medicinais'],
            ['codigo' => '19', 'titulo' => 'Materiais e Órteses, Próteses e Materiais Especiais (OPME)'],
            ['codigo' => '20', 'titulo' => 'Medicamentos'],
            ['codigo' => '22', 'titulo' => 'Procedimentos e eventos em saúde'],
            ['codigo' => '90', 'titulo' => 'Tabela Própria Pacote Odontológico'],
            ['codigo' => '98', 'titulo' => 'Tabela Própria de Pacotes']
        ];
    }

    public static function getTipoConsulta()
    {
        return [
            ['codigo' => '1', 'titulo' => 'Primeira Consulta'],
            ['codigo' => '2', 'titulo' => 'Retorno'],
            ['codigo' => '3', 'titulo' => 'Pré-natal'],
            ['codigo' => '4', 'titulo' => 'Por encaminhamento']
        ];
    }

    public static function getRegimeAtendimento()
    {
        return [
            ['codigo' => '1', 'titulo' => 'Ambulatorial'],
            ['codigo' => '2', 'titulo' => 'Domiciliar'],
            ['codigo' => '3', 'titulo' => 'Internação'],
            ['codigo' => '4', 'titulo' => 'Pronto Socorro'],
            ['codigo' => '5', 'titulo' => 'Telessaúde']
        ];
    }

    public static function getCoberturaEspecial()
    {
        return [
            ['codigo' => '01', 'titulo' => 'Gestante'],
            ['codigo' => '02', 'titulo' => 'Pré-operatório'],
            ['codigo' => '03', 'titulo' => 'Pós-operatório']
        ];
    }


    public static function getIndicacaoAcidente()
    {
        return [
            ['codigo' => '0', 'titulo' => 'Trabalho'],
            ['codigo' => '1', 'titulo' => 'Trânsito'],
            ['codigo' => '2', 'titulo' => 'Outros'],
            ['codigo' => '9', 'titulo' => 'Não Acidente']
        ];
    }


}

