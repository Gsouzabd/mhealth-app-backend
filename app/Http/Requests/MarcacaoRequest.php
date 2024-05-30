<?php

namespace App\Http\Requests;

use App\Enums\MarcacaoTipoRecorrencia;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MarcacaoRequest extends FormRequest
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
            'id_paciente' => 'required|exists:pacientes,id',
            'id_funcionario' => 'required|exists:funcionarios,id',
            'id_especialidade' => 'required|exists:especialidades,id',
            'convenio' => 'required|exists:convenios,id',
            'data_inicial' => 'required|date', // Valida se é uma data no formato YYYY-MM-DD
            'horario' => 'required|date_format:H:i:s', // Valida se é uma hora no formato HH:MM:SS
            'duracao' => 'required|integer|min:1', // Supondo que duração deve ser pelo menos 1 minuto
            'recorrencia' => 'required|boolean',
            'tipoRecorrencia' => [
                'required_if:recorrencia,true',
                'string',
                Rule::in(array_column(MarcacaoTipoRecorrencia::cases(), 'value'))
            ],
            'vezesRecorrencia' => 'required_if:recorrencia,true|integer|min:1',
            'marcadoPor' => 'required|exists:funcionarios,id',
            'unidade' => 'required|exists:unidades,id',
        ];
    }


}
