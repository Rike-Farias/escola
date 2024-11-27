<?php

namespace Database\Factories;

use App\Models\Onibus;
use App\Models\Manutencao;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManutencaoFactory extends Factory
{
    protected $model = Manutencao::class;

    public function definition(): array
    {
        return [
            'onibus_id' => Onibus::factory(), // Usa o Factory do Onibus para associar um ônibus
            'data' => $this->faker->date(), // Data aleatória
            'nome_motorista' => $this->faker->name(), // Nome do motorista aleatório
            'rota' => $this->faker->word(), // Rota aleatória
            'km_atual' => $this->faker->numberBetween(1000, 100000), // Km aleatório
            'problema' => $this->faker->words(3, true), // Problema gerado como um array de strings
            'data_da_manutencao' => $this->faker->date(), // Data da manutenção aleatória
            'status_manutencao' => $this->faker->boolean(), // Status de manutenção (verdadeiro ou falso)
        ];
    }
}

