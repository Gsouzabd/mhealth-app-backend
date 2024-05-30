<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuiaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_lote' => 'nullable|exists:lotes,id',
            'lote_numero' => 'nullable',
            'status' => 'required',
            'id_paciente' => 'required|exists:pacientes,id',
            'id_convenio' => 'required|exists:convenios,id',
            'id_procedimento' => 'required|exists:procedimentos,id',
            'data' => 'required|date',
            'quantidade' => 'required|integer',
            'valor' => 'required|numeric',
            'id_contratado_executante' => 'required|exists:unidades,id',
            'cnpj_contratado' => 'nullable|digits:14',
            'id_profissional_executante' => 'required|exists:funcionarios,id',
            'id_conselho' => 'required|exists:conselhos,id',
            'uf_conselho_profissional' => ['nullable', 'string', 'max:2', 'in:11,12,13,14,15,16,17,21,22,23,24,25,26,27,28,29,31,32,33,35,41,42,43,50,51,52,53,98'],
            'indicador_acidente' => ['required', 'string', 'in:0,1,2,9'],
            'cobertura_especial' => ['required', 'string', 'max:2', 'in:01,02,03'],
            'atendimento_regime' => ['required', 'string', 'in:01,02,03,04,05'],
            'tipo_consulta' => ['required', 'string', 'in:1,2,3,4'],
            'tabela' => ['required', 'string', 'in:18,19,20,22,90,98,00'],
        ];
    }
}
