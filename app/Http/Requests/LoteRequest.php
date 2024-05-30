<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_convenio' => 'required|integer|exists:convenios,id',
            'numero' => 'required|string',
            'tipo' => 'required|string',
            'data' => 'required|date',
            'status' => 'required|string',
            'valor_total' => 'required|numeric',
        ];
    }
}
