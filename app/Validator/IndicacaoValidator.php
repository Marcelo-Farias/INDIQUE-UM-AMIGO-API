<?php


namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class IndicacaoValidator
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        return Validator::make($this->request->all(), $this->rules(), $this->messages());
    }

    public function rules()
    {
        return [
            "nome" => "required",
            "cpf" => "required | unique:indicacoes,cpf",
            "telefone" => "required",
            "email" => "required|email"
        ];
    }

    public function messages()
    {
    return [];
    }


}
