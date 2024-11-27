<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('motoristas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_motorista');
            $table->date('data_nascimento');
            $table->string('cpf_motorista');
            $table->string('endereco');
            $table->string('registro_cnh');
            $table->string('categoria_cnh');
            $table->date('validade_habilitacao');
            $table->date('data_admissao');
            $table->integer('tempo_empresa_atual')->nullable();  // Em anos
            $table->date('data_demissao')->nullable();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->boolean('documentacao_pendente')->default(false);
            $table->json('documentos_pendentes')->nullable();  // Documentos faltantes
            $table->string('rota');
            $table->string('itinerario');
            $table->integer('km_rota');
            $table->string('placa_onibus');
            $table->boolean('curso_condutor_atualizado');
            $table->date('data_validade_curso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motoristas');
    }
};
