<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *   @OA\Property(property="logo", type="string", example="url_to_logo.png"),
 *   @OA\Property(property="nome_empresa", type="string", example="Nome da Empresa"),
 *   @OA\Property(property="telefone", type="string", example="+5511999999999"),
 *   @OA\Property(property="titulo", type="string", example="Título da Empresa"),
 *   @OA\Property(property="descricao", type="string", example="Descrição da Empresa"),
 *   @OA\Property(property="textoFooter", type="string", example="Texto do rodapé da Empresa"),
 *   @OA\Property(property="banner_app", type="string", example="url_to_banner_app.png"),
 *   @OA\Property(property="banner_site", type="string", example="url_to_banner_site.png"),
 *   @OA\Property(property="banner_site_mobile", type="string", example="url_to_banner_site_mobile.png"),
 *   @OA\Property(property="segunda_sexta", type="boolean", example=true),
 *   @OA\Property(property="segunda_sexta_horario_inicio", type="string", example="08:00"),
 *   @OA\Property(property="segunda_sexta_horario_fim", type="string", example="18:00"),
 *   @OA\Property(property="sabado_domingo", type="boolean", example=true),
 *   @OA\Property(property="sabado_domingo_horario_inicio", type="string", example="08:00"),
 *   @OA\Property(property="sabado_domingo_horario_fim", type="string", example="18:00"),
 * )
 */
class Configuracao extends Model
{
    use HasFactory;

    protected $table = 'configuracoes';

    protected $fillable = [
        "logo",
        "nome_empresa",
        "telefone",
        "titulo",
        "descricao",
        "textoFooter",
        "banner_app",
        "banner_site",
        "banner_site_mobile",
        "segunda_sexta", //boolean, aberto de segunda a sexta
        "segunda_sexta_horario_inicio", //string, "08:00"
        "segunda_sexta_horario_fim", //string, "18:00
        "sabado_domingo",  //boolean, aberto sábado e domingo
        "sabado_domingo_horario_inicio", //string, "08:00"
        "sabado_domingo_horario_fim", //string, "18:00
    ];

}
