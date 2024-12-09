<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssentosToOnibusesTable extends Migration
{
    public function up(): void
    {
        Schema::table('onibuses', function (Blueprint $table) {
            $table->integer('assentos')->default(59)->after('onibus_status'); // Adiciona a coluna com valor padrão 59
        });
    }

    public function down(): void
    {
        Schema::table('onibuses', function (Blueprint $table) {
            $table->dropColumn('assentos'); // Remove a coluna se a migration for revertida
        });
    }
}

