<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
            'cpf' => 'required|unique:funcionarios|min:11',
            'nome' => 'required|min:3|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email',
            'password' => 'required|string',
            'administrativo' => 'required|boolean',
            'especialista' => 'required|boolean',
        ];
    }
}
