<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencoesTable extends Migration
{
    public function up(): void
    {
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('onibus_id')->constrained('onibuses'); // Chave estrangeira para a tabela onibuses
            $table->date('data');
            $table->string('nome_motorista');
            $table->string('rota');
            $table->string('km_atual');
            $table->json('problema'); // Array de string armazenado como JSON
            $table->date('data_da_manutencao');
            $table->boolean('status_manutencao');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manutencoes');
    }
}

