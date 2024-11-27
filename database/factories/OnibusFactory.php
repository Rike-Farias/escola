<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OnibusFactory extends Factory
{
    protected $model = \App\Models\Onibus::class;

    public function definition(): array
    {
        return [
            'placa_onibus' => $this->faker->unique()->regexify('[A-Z]{3}[0-9][A-Z][0-9]{2}'),
            'onibus_autorizado' => true,
            'data_inicial_da_autorizacao' => '2024-08-15',
            'vencimento_da_autorizacao' => '2025-01-15',
            'dias_para_o_vencimento_da_autorizacao' => now()->diffInDays('2025-01-15', false),
            'onibus_licenciado' => true,
            'data_inicial_da_licenca' => '2024-02-14',
            'vencimento_da_licenca' => '2025-02-14',
            'dias_para_o_vencimento_da_licenca' => now()->diffInDays('2025-02-14', false),
            'onibus_status' => true,
        ];
    }
}

