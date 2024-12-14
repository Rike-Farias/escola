<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMaintenanceTableForReserva extends Migration
{
    public function up(): void
    {
        Schema::table('manutencoes', function (Blueprint $table) {
            $table->foreignId('reserva_onibus_id')
                ->nullable()
                ->constrained('onibuses') // Chave estrangeira para onibuses
                ->nullOnDelete(); // Caso o ônibus seja deletado, seta null
            
            $table->softDeletes(); // Adiciona soft deletes

            // Garante que created_at e updated_at existam
            if (!Schema::hasColumn('manutencoes', 'created_at') || !Schema::hasColumn('manutencoes', 'updated_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('manutencoes', function (Blueprint $table) {
            $table->dropForeign(['reserva_onibus_id']);
            $table->dropColumn('reserva_onibus_id');
            $table->dropSoftDeletes();
        });
    }
}

