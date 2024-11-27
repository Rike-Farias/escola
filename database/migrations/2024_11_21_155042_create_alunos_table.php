<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_aluno');
            $table->date('data_nascimento');
            $table->string('cpf_aluno')->unique();
            $table->string('sexo');
            $table->string('nome_pai');
            $table->string('nome_mae');
            $table->string('telefone_responsavel');
            $table->string('etnia');
            $table->string('status');
            $table->boolean('bolsa_familia');
            $table->string('status_transporte');
            $table->string('numero_matricula_rede');
            $table->string('numero_inep');
            $table->string('deficiencia')->nullable();
            $table->string('etapa_ensino');
            $table->string('turma');
            $table->string('endereco');
            $table->string('tipo_vinculo');
            $table->string('sigla_concessionaria_energia');
            $table->string('unidade_consumidora');
            $table->string('turno');
            $table->string('rota');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
