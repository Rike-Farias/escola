<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnibusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('onibuses', function (Blueprint $table) { // Mude de 'onibus' para 'onibuses'
            $table->id();
            $table->string('placa_onibus')->unique();
            $table->boolean('onibus_autorizado');
            $table->date('data_inicial_da_autorizacao');
            $table->date('vencimento_da_autorizacao');
            $table->integer('dias_para_o_vencimento_da_autorizacao');
            $table->boolean('onibus_licenciado');
            $table->date('data_inicial_da_licenca');
            $table->date('vencimento_da_licenca');
            $table->integer('dias_para_o_vencimento_da_licenca');
            $table->boolean('onibus_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onibus');
    }
}

