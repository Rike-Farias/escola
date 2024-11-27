<?php

namespace Database\Factories;

use App\Models\Motorista;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class MotoristaFactory extends Factory
{
    protected $model = Motorista::class;

    public function definition()
    {
        return [
            'nome_motorista' => $this->faker->name,
            'data_nascimento' => $this->faker->date('Y-m-d', '-30 years'),
            'cpf_motorista' => $this->faker->numerify('###.###.###-##'), // Gera um CPF no formato de string
            'endereco' => $this->faker->address,
            'registro_cnh' => $this->faker->word,
            'categoria_cnh' => $this->faker->randomElement(['A', 'B', 'C']),
            'validade_habilitacao' => $this->faker->date('Y-m-d', '+10 years'),
            'data_admissao' => $this->faker->date('Y-m-d', '-5 years'),
            'tempo_empresa_atual' => $this->faker->numberBetween(1, 10),  // Em anos
            'data_demissao' => null,  // Motorista ainda está ativo
            'status' => $this->faker->randomElement(['Ativo', 'Inativo']),
            'documentacao_pendente' => $this->faker->boolean,
            'documentos_pendentes' => $this->faker->boolean ? $this->faker->words(3) : null,  // Pode gerar uma lista de documentos pendentes
            'rota' => $this->faker->word,
            'itinerario' => $this->faker->sentence,
            'km_rota' => $this->faker->numberBetween(50, 500),
            'placa_onibus' => $this->faker->bothify('???-####'),
            'curso_condutor_atualizado' => $this->faker->boolean,
            'data_validade_curso' => $this->faker->date('Y-m-d', '+2 years'),
        ];
    }
}

