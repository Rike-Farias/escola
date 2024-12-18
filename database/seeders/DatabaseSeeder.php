<?php

namespace Database\Seeders;

use App\Models\Monitora;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AlunoSeeder::class);
        

        // Executa o seeder da Monitora
        // $this->call(MonitoraSeeder::class);

        // $this->call(LavagemVeiculoSeeder::class);

        // $this->call([
        //     // Outros seeders que você tem
        //     // ManutencaoSeeder::class, // Adicione o seeder de manutenções aqui
            
        // ]);
    }
}
