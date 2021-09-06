<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StatusDaIndicacao extends Model
{
    protected $table = 'statusDasIndicacoes';
    public $timestamps = false;
    protected $fillable = ['descricao'];
    protected $appends = ['links'];

    public function indicacao()
    {
        $this->hasOne(Indicacao::class);
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/statusdasindicacoes/' . $this->id,
            'indicacao' => '/api/indicacoes/' . $this->id
        ];
    }
}
