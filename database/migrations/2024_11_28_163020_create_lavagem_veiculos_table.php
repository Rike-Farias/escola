<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lavagem_veiculo', function (Blueprint $table) {
            $table->id();
            $table->date('data_envio_solicitacao');
            $table->string('placa_onibus');
            $table->string('nome_motorista');
            $table->string('rota');
            $table->integer('km_rota');
            $table->date('data_lavagem_programada');
            $table->date('data_lavagem_realizada')->nullable();
            $table->time('hora_lavagem')->nullable();
            $table->string('servicos_realizados');
            $table->decimal('valor_servico', 8, 2);
            $table->boolean('status_lavagem')->default(false);
            $table->date('data_prevista_proxima_lavagem')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lavagem_veiculo');
    }
};
