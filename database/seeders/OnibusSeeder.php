<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Onibus;

class OnibusSeeder extends Seeder
{
    public function run(): void
    {
        $placas = [
            'OHN1H82',
            'OHQ5B32',
            'OHQ5A72',
            'OHQ6A02',
            'OHN2H82',
            'OHN1E42',
            'OHN2J02',
            'OHQ6G72',
            'OHQ3F92',
            'OHN1E52',
            'OHQ6J72',
            'OHN1H52',
        ];

        foreach ($placas as $placa) {
            Onibus::create([
                'placa_onibus' => $placa,
                'onibus_autorizado' => true,
                'data_inicial_da_autorizacao' => '2024-08-15',
                'vencimento_da_autorizacao' => '2025-01-15',
                'dias_para_o_vencimento_da_autorizacao' => now()->diffInDays('2025-01-15', false),
                'onibus_licenciado' => true,
                'data_inicial_da_licenca' => '2024-02-14',
                'vencimento_da_licenca' => '2025-02-14',
                'dias_para_o_vencimento_da_licenca' => now()->diffInDays('2025-02-14', false),
                'onibus_status' => true,
            ]);
        }
    }
}

