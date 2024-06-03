<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'cpf' => 'required|unique:pacientes|min:11',
            'nome' => 'required|min:3|max:255',
            'email' => 'required|email|unique:pacientes',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|string|max:1',
            // 'responsaveis' => 'required|array',
        ];
    }
}
