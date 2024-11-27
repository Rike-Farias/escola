<?php

namespace Database\Factories;

use App\Models\Monitora;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class MonitoraFactory extends Factory
{
    protected $model = Monitora::class;

    public function definition()
    {
        return [
            'nome_monitora' => $this->faker->name,
            'data_nascimento' => $this->faker->date(),
            'cpf_monitora' => $this->faker->numerify('###.###.###-##'), // Gera um CPF no formato de string
            'endereco' => $this->faker->address,
            'data_admissao' => $this->faker->date(),
            'tempo_empresa_atual' => $this->faker->numberBetween(1, 20),
            'status' => $this->faker->randomElement(['Ativo', 'Inativo']),
            'documentacao_pendente' => $this->faker->boolean(),
            'rota' => $this->faker->word,
            'itinerario' => $this->faker->sentence,
            'km_rota' => $this->faker->numberBetween(10, 500),
            'placa_onibus' => $this->faker->bothify('???-####'),
            'curso_monitora_atualizado' => $this->faker->boolean(),
            'validade_curso' => $this->faker->date(),
        ];
    }
}

