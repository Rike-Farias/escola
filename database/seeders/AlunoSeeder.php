<?php

namespace Database\Seeders;
use App\Models\Aluno;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usando o Factory para criar 5 alunos aleatórios
        Aluno::factory()->count(40)->create();
    }
}
