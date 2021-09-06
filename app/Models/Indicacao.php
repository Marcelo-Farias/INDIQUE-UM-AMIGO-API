<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    protected $table = 'indicacoes';
    public $timestamps = false;
    protected $fillable = ['nome', 'cpf','telefone','email','status_id'];
    protected $appends = ['links'];

    public function status()
    {
        $this->belongsTo(StatusDaIndicacao::class);
    }

    public function setNomeAttribute($nome)
    {
        //Retirando espaços do início e final da string.
        $nomeClean = trim($nome);

        $this->attributes['nome'] = $nomeClean;
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/indicacoes/' . $this->id,
            'statusDaIndicacao' => '/api/statusdasindicacoes/' . $this->id
        ];
    }
}
