<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_monitora',
        'data_nascimento',
        'cpf_monitora',
        'endereco',
        'data_admissao',
        'tempo_empresa_atual',
        'data_demissao',
        'status',
        'documentacao_pendente',
        'documentos_pendentes',
        'rota',
        'itinerario',
        'km_rota',
        'placa_onibus',
        'curso_monitora_atualizado',
        'validade_curso',
    ];

    protected $casts = [
        'documentos_pendentes' => 'array',
        'data_nascimento' => 'date',
        'data_admissao' => 'date',
        'data_demissao' => 'date',
        'validade_curso' => 'date',
    ];
}
