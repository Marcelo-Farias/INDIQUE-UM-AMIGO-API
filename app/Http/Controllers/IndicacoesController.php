<?php


namespace App\Http\Controllers;


use App\Models\Indicacao;
use App\Models\StatusDaIndicacao;
use Illuminate\Http\Request;

class IndicacoesController extends BaseController
{
    public function __construct()
    {
        $this->classe = Indicacao::class;
    }

    /**
     * Esse método cria um elemento na tabela  indicacoes.
     * O que implica também criar um elemento na tabela  statusDasIndicacoes.
     */
    public function store(Request $request)
    {
        //Primeiramente, precisamos criar um elemento na tabela   statusDasIndicacoes.
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
                ['erro'=> 'Dados inválidos. Não foi possível concluir a indicação atual.'],
                422
            );
        }

        //Novo elemento criado com sucesso na tabela  indicacoes.
        return $this->show($idNovo);

    }
}
