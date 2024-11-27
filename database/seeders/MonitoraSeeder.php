<?php

namespace Database\Seeders;

use App\Models\Monitora;
use Illuminate\Database\Seeder;

class MonitoraSeeder extends Seeder
{
    public function run()
    {
        // Cria 13 monitoras, uma para cada rota.
        Monitora::factory()->count(13)->create();
    }
}
