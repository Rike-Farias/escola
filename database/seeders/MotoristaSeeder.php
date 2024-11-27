<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Motorista;

class MotoristaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definindo as 13 rotas fictícias
        $rotas = [
            '001', '002', '003', '004', '005', 
            '006', '007', '008', '009', '010', 
            '011', '012', '013'
        ];

        // Criando 13 motoristas, cada um com uma rota diferente
        foreach ($rotas as $rota) {
            Motorista::factory()->create([
                'rota' => $rota  // Atribuindo uma rota diferente para cada motorista
            ]);
        }
    }
}
