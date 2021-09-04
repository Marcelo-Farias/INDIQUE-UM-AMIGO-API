<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    protected $table = 'indicacoes';
    public $timestamps = false;
    protected $fillable = ['nome', 'cpf','telefone','email','status_id'];

    public function status()
    {
        $this->belongsTo(StatusDaIndicacao::class);
    }
}
