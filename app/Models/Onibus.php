<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onibus extends Model
{
    use HasFactory;

    protected $table = 'onibuses'; // Explicitamente define o nome da tabela

    protected $fillable = [
        'placa_onibus',
        'onibus_autorizado',
        'data_inicial_da_autorizacao',
        'vencimento_da_autorizacao',
        'dias_para_o_vencimento_da_autorizacao',
        'onibus_licenciado',
        'data_inicial_da_licenca',
        'vencimento_da_licenca',
        'dias_para_o_vencimento_da_licenca',
        'onibus_status',
    ];

    // Accessors (opcional para calcular os dias restantes automaticamente)
    public function getDiasParaOVencimentoDaAutorizacaoAttribute(): int
    {
        return now()->diffInDays($this->vencimento_da_autorizacao, false);
    }

    public function getDiasParaOVencimentoDaLicencaAttribute(): int
    {
        return now()->diffInDays($this->vencimento_da_licenca, false);
    }
}

