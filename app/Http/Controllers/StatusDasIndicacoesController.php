<?php


namespace App\Http\Controllers;


use App\Models\StatusDaIndicacao;

class StatusDasIndicacoesController extends BaseController
{
    public function __construct()
    {
        $this->classe = StatusDaIndicacao::class;
    }
}
