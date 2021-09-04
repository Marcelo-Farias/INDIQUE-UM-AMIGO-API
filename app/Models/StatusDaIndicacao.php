<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StatusDaIndicacao extends Model
{
    protected $table = 'statusDasIndicacoes';
    public $timestamps = false;
    protected $fillable = ['descricao'];

    public function indicacao()
    {
        $this->hasOne(Indicacao::class);
    }
}
