<?php

namespace Database\Factories;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome_aluno' => $this->faker->name(),
            'data_nascimento' => $this->faker->date(),
            'cpf_aluno' => $this->faker->numerify('###.###.###-##'),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'nome_pai' => $this->faker->name(),
            'nome_mae' => $this->faker->name(),
            'telefone_responsavel' => $this->faker->phoneNumber(),
            'etnia' => $this->faker->randomElement(['Branco', 'Negro', 'Pardo', 'Indígena', 'Asiático']),
            'status' => $this->faker->randomElement(['Ativo', 'Inativo']),
            'bolsa_familia' => $this->faker->boolean(),
            'status_transporte' => $this->faker->boolean(),
            'numero_matricula_rede' => $this->faker->word(),
            'numero_inep' => $this->faker->word(),
            'deficiencia' => $this->faker->randomElement(['0', '1']),
            'etapa_ensino' => $this->faker->randomElement(['Pré-Escola', 'Fundamental I', 'Fundamental II']),
            'turma' => $this->faker->randomElement(['1A', '2A', '3A','4A', '5A','1B', '2B', '3B','4B', '5B', '1C', '2C', '3C','4C', '5C','1D', '2D', '3D','4D', '5D']),
            'endereco' => $this->faker->address(),
            'tipo_vinculo' => $this->faker->randomElement(['Municipal', 'Estadual']),
            'sigla_concessionaria_energia' => $this->faker->randomElement(['Energisa']),
            'unidade_consumidora' => $this->faker->word(),
            'turno' => $this->faker->randomElement(['Matutino', 'Vespertino']),
            'rota' => $this->faker->randomElement(['1', '2', '3','4', '5','6','7','8', '9','10','11','12','13']),
        ];
    }
}

