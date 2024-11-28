<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavagemVeiculo extends Model
{
    use HasFactory;

    /**
     * A tabela associada ao modelo.
     */
    protected $table = 'lavagem_veiculo';

    /**
     * Os atributos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'data_envio_solicitacao',
        'placa_onibus',
        'nome_motorista',
        'rota',
        'km_rota',
        'data_lavagem_programada',
        'data_lavagem_realizada',
        'hora_lavagem',
        'servicos_realizados',
        'valor_servico',
        'status_lavagem',
        'data_prevista_proxima_lavagem',
    ];
}
