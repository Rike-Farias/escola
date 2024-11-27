<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_motorista',
        'data_nascimento',
        'cpf_motorista',
        'endereco',
        'registro_cnh',
        'categoria_cnh',
        'validade_habilitacao',
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
        'curso_condutor_atualizado',
        'data_validade_curso',
    ];

    // O campo 'documentos_pendentes' será tratado como um JSON
    protected $casts = [
        'documentos_pendentes' => 'array',
    ];
}
