<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manutencao;

class ManutencaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gerar 13 manutenções fictícias
        Manutencao::factory(13)->create();
    }
}

