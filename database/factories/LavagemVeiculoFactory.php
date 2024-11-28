<?php

namespace Database\Factories;

use App\Models\LavagemVeiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class LavagemVeiculoFactory extends Factory
{
    protected $model = LavagemVeiculo::class;

    /**
     * Defina o estado inicial do modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'data_envio_solicitacao' => $this->faker->date(),
            'placa_onibus' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{4}'),
            'nome_motorista' => $this->faker->name(),
            'rota' => $this->faker->word(),
            'km_rota' => $this->faker->randomNumber(3),
            'data_lavagem_programada' => $this->faker->date(),
            'data_lavagem_realizada' => $this->faker->optional()->date(),
            'hora_lavagem' => $this->faker->optional()->time(),
            'servicos_realizados' => $this->faker->sentence(),
            'valor_servico' => $this->faker->randomFloat(2, 100, 500),
            'status_lavagem' => $this->faker->boolean(),
            'data_prevista_proxima_lavagem' => $this->faker->date(),
        ];
    }
}

