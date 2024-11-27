<?php

namespace App\Imports;

use App\Models\Aluno;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class AlunosImport implements ToModel, WithHeadingRow
{
    /**
     * Mapear as linhas do arquivo de planilha para o modelo Aluno.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Aluno([
            'nome_aluno' => $row['nome_do_aluno'],
            'data_nascimento' => \Carbon\Carbon::parse($row['data_de_nascimento']),
            'cpf_aluno' => $row['cpf_do_aluno'],
            'sexo' => $row['sexo'],
            'nome_pai' => $row['nome_do_pai'],
            'nome_mae' => $row['nome_da_mae'],
            'telefone_responsavel' => $row['telefone_do_responsavel'],
            'etnia' => $row['etnia'],
            'status' => $row['status'],
            'bolsa_familia' => $row['bolsa_familia'] == 'sim',
            'status_transporte' => $row['status_do_transporte'],
            'numero_matricula_rede' => $row['numero_de_matricula_na_rede'],
            'numero_inep' => $row['numero_do_inep'],
            'deficiencia' => $row['deficiencia'] ?? null,
            'etapa_ensino' => $row['etapa_de_ensino'],
            'turma' => $row['turma'],
            'endereco' => $row['endereco'],
            'tipo_vinculo' => $row['tipo_de_vinculo'],
            'sigla_concessionaria_energia' => $row['sigla_da_concessionaria_de_energia'],
            'unidade_consumidora' => $row['unidade_consumidora'],
            'turno' => $row['turno'],
            'rota' => $row['rota'],
        ]);
    }
}
