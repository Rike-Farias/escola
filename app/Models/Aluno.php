<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_aluno',
        'data_nascimento',
        'cpf_aluno',
        'sexo',
        'nome_pai',
        'nome_mae',
        'telefone_responsavel',
        'etnia',
        'status',
        'bolsa_familia',
        'status_transporte',
        'numero_matricula_rede',
        'numero_inep',
        'deficiencia',
        'etapa_ensino',
        'turma',
        'endereco',
        'tipo_vinculo',
        'sigla_concessionaria_energia',
        'unidade_consumidora',
        'turno',
        'rota',
    ];
}
