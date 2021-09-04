<?php


namespace App\Http\Controllers;


use App\Models\Indicacao;
use App\Models\StatusDaIndicacao;

abstract class BaseController
{
    protected string $classe;


    /**
     * Esse método retorna uma coleção (\Illuminate\Database\Eloquent\Collection)
     * com todos os ítens adicionados na tabela correspondente.
     */
    public function index()
    {
        return $this->classe::all();
    }

    /**
     * Esse método busca uma única linha na tabela correspondente, a partir do  id  informado.
     */
    public function show(int $id)
    {
        $recurso = $this->classe::find($id);

        // Verificando se o  id  informado existe na tabela.
        if (is_null($recurso)){
            return response()->json('',204);
        }

        return response()->json($recurso);
    }

    /**
     * Esse método altera uma linha da tabela  statusDasIndicacoes.
     * OBS: O campo  'descricao'  pode ser alterado apenas na ordem
     * '1.INICIADA' => '2.EM PROCESSO' => '3.FINALIZADA'.
     */
    public function update(int $id)
    {
        $statusDaIndicacao = StatusDaIndicacao::find($id);

        // Verificando se o  id  informado existe na tabela (statusDaIndicacao).
        if (is_null($statusDaIndicacao)){
            return response()->json(['erro'=>'Recurso não encontrado.'],404);
        }

        $descricao = $statusDaIndicacao->descricao;

        // Analisando o primeiro caractere da string.
        if ($descricao[0] === '1'){
            $statusDaIndicacao->descricao = '2.EM PROCESSO';
            $statusDaIndicacao->save();

            return response()->json($statusDaIndicacao);
        }

        if ($descricao[0] === '2'){
            $statusDaIndicacao->descricao = '3.FINALIZADA';
            $statusDaIndicacao->save();

            return response()->json($statusDaIndicacao);
        }

        if ($descricao[0] ===  '3'){
            return response()->json([
                'erro' => 'Atualização não permitida. Valor máximo já alcançado.'
            ], 405
            );
        }
    }

    /**
     * Esse método exclui uma linha da tabela  indicacoes.
     * E exclui a linha correspondente na tabela  statusDasIndicacoes.
     * OBS: As exclusões só irão ocorrer se o  id  informado existir.
     */
    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = Indicacao::destroy($id);
        if ($qtdRecursosRemovidos === 0){
            return response()->json([
                'erro'=> "Recurso não encontrado."
            ], 404 );
        }

        //Caso em que apagamos a linha na tabela  indicacao  com sucesso.
        //Apagando a linha correspondente na tabela  statusDasIndicacoes.
        StatusDaIndicacao::destroy($id);
        return response()->json('',204);
    }


}
