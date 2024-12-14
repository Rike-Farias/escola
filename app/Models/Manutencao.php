<?php

namespace App\Models;

use App\Models\Onibus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    use HasFactory;

    protected $table = 'manutencoes'; // Define o nome da tabela

    protected $fillable = [
        'onibus_id',
        'data',
        'nome_motorista',
        'rota',
        'km_atual',
        'problema',
        'data_da_manutencao',
        'status_manutencao',
        'reserva_onibus_id',
    ];

    protected $casts = [
        'problema' => 'array', // Faz o cast do campo 'problema' para um array
    ];

    public function onibus()
    {
        return $this->belongsTo(Onibus::class, 'onibus_id');
    }

    public function reservaOnibus()
    {
        return $this->belongsTo(Onibus::class, 'reserva_onibus_id');
    }
}
