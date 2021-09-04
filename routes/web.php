<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return \App\Models\Indicacao::all();
});

$router->group(['prefix'=>'/api'], function () use ($router){

    $router->group(['prefix'=>'/statusdasindicacoes'], function () use ($router){

        //Exibir todos os elementos da tabela  statusDasIndicacoes.
        $router->get('', 'StatusDasIndicacoesController@index');
        //Buscar um único elemento da tabela  statusDasIndicacoes.
        $router->get('/{id}', 'StatusDasIndicacoesController@show');
        //Alterar uma linha da tabela  statusDasIndicacoes.
        $router->put('/{id}', 'StatusDasIndicacoesController@update');
        //Deletar uma linha da tabela  statusDasIndicacoes. Implica também deletar um elemento na tabela  indicacoes.
        $router->delete('/{id}', 'StatusDasIndicacoesController@destroy');

    });

    $router->group(['prefix' => 'indicacoes'], function () use ($router){

        //Exibir todos os elementos da tabela  indicacoes.
        $router->get('', 'IndicacoesController@index');
        //Criar um elemento na tabela  indicacoes. Implica também criar um elemento na tabela  statusDasIndicacoes.
        $router->post('', 'IndicacoesController@store');
        //Buscar um único elemento da tabela  indicacoes.
        $router->get('/{id}', 'IndicacoesController@show');
        //Alterar uma linha da tabela  indicacoes.
        $router->put('/{id}', 'IndicacoesController@update');
        //Deletar uma linha da tabela  indicacoes. Implica também deletar um elemento na tabela  statusDasIndicacoes.
        $router->delete('/{id}', 'IndicacoesController@destroy');

    });

});
