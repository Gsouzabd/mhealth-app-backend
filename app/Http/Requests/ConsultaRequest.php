<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Change to 'true' if authorization is not required or implement your own logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dataHora' => 'required|date',
            'id_funcionario' => 'required|integer|exists:funcionarios,id',
            'id_especialidade' => 'required|integer|exists:especialidades,id',
            'unidadeId' => 'required|integer|exists:unidades,id',
            'id_paciente' => 'required|string|exists:pacientes,id',
        ];
    }
}