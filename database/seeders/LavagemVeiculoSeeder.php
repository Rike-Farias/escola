<?php

namespace Database\Seeders;

use App\Models\LavagemVeiculo;
use Illuminate\Database\Seeder;

class LavagemVeiculoSeeder extends Seeder
{
    /**
     * Execute as sementes do banco de dados.
     *
     * @return void
     */
    public function run()
    {
        // Criar 5 registros usando o factory
        LavagemVeiculo::factory()->count(5)->create();
    }
}
