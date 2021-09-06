<?php


namespace App\Http\Controllers;

use App\Models\Indicacao;
use App\Models\StatusDaIndicacao;
use App\Validator\CPFValidator;
use App\Validator\IndicacaoValidator;
use Illuminate\Http\Request;


class IndicacoesController extends BaseController
{
    use CPFValidator;

    /**
     * @var IndicacaoValidator
     */
    private $validator;

    /**
     * @var Request
     */
    private $request;



    public function __construct(IndicacaoValidator $indicacaoValidator, Request $request)
    {
        $this->classe = Indicacao::class;
        $this->validator = $indicacaoValidator;
        $this->request = $request;
    }

    /**
     * Esse método cria um elemento na tabela  indicacoes.
     * O que implica também criar um elemento na tabela  statusDasIndicacoes.
     */
    public function store(Request $request)
    {
        //Validando os dados recebidos.
        $validator = $this->validator->validate();

        //Verificando o resultado da validação.
        if ($validator->fails()){
            return response()->json([
                "message"=> "Erro. Não foi possível concluir a indicação atual.",
                "error" => $validator->errors()
                ], 422
            );
        }

        //Validação extra para o CPF.
        if(!$this->validateCPF($this->request->cpf)) {
            return response()->json([
                'message'=> 'Erro. Não foi possível concluir a indicação atual.',
                'error' => 'CPF inválido.'
                ], 422
            );
        }

        //Primeiro, precisamos criar um elemento na tabela   statusDasIndicacoes.
        //O  id  desse novo elemento será usado no campo  status_id  da tabela  indicacoes.
        $status_id = StatusDaIndicacao::create([])->id;

        try {
            //Criando um elemento na tabela  indicacoes.
            //OBS: $request->all() não possui a informação 'status_id'.
            $idNovo = Indicacao::create(
                    array_merge($request->all(), ["status_id" => $status_id])
            )->id;

        } catch ( \Throwable $error){
            //Apagando o elemento criado na tabela  statusDasIndicacoes.
            StatusDaIndicacao::destroy($status_id);
            return response()->json(
                ['message'=> 'Erro. Não foi possível concluir a indicação atual.'],
                422
            );
        }

        //Novo elemento criado com sucesso na tabela  indicacoes.
        return $this->show($idNovo);

    }

    /**
     *Esse método busca uma única linha na tabela  statusDasIndicacoes  , a partir do  id  informado.
     */
    public function buscarStatus(int $id)
    {
        $recurso = StatusDaIndicacao::find($id);

        // Verificando se o  id  informado existe na tabela  statusDasIndicacoes.
        if (is_null($recurso)){
            return response()->json('',204);
        }

        return response()->json($recurso);
    }
}
