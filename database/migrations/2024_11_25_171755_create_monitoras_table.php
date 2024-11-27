<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorasTable extends Migration
{
    public function up()
    {
        Schema::create('monitoras', function (Blueprint $table) {
            $table->id();
            $table->string('nome_monitora');
            $table->date('data_nascimento');
            $table->string('cpf_monitora');
            $table->string('endereco');
            $table->date('data_admissao');
            $table->integer('tempo_empresa_atual');
            $table->date('data_demissao')->nullable();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->boolean('documentacao_pendente');
            $table->json('documentos_pendentes')->nullable();
            $table->string('rota');
            $table->string('itinerario');
            $table->integer('km_rota');
            $table->string('placa_onibus');
            $table->boolean('curso_monitora_atualizado');
            $table->date('validade_curso');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitoras');
    }
}

