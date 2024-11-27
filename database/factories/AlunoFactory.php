<?php

// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
//  */
// class AlunoFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             //
//         ];
//     }
// }

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
            // 'cpf_aluno' => $this->faker->unique()->cpf(),
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
            'deficiencia' => $this->faker->word(),
            'etapa_ensino' => $this->faker->randomElement(['Fundamental', 'Médio', 'Superior']),
            'turma' => $this->faker->word(),
            'endereco' => $this->faker->address(),
            'tipo_vinculo' => $this->faker->word(),
            'sigla_concessionaria_energia' => $this->faker->word(),
            'unidade_consumidora' => $this->faker->word(),
            'turno' => $this->faker->randomElement(['Matutino', 'Vespertino', 'Noturno']),
            'rota' => $this->faker->word(),
        ];
    }
}

