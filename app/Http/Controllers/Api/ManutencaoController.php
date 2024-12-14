<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Manutencao;
use Illuminate\Http\Request;
use App\Models\Onibus;

class ManutencaoController extends Controller
{
    /**
     * Exibe a lista de manutenções.
     */
    public function index()
    {
        try {
            $manutencao = Manutencao::with('onibus')->get();
            return response()->json([
                'status' => true,
                'manutencao' => $manutencao
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao listar as manutenções: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Armazena uma nova manutenção.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'onibus_id' => 'required|exists:onibuses,id', // Validação para garantir que o onibus exista
                'data' => 'required|date',
                'nome_motorista' => 'required|string',
                'rota' => 'required|string',
                'km_atual' => 'required|string',
                'problema' => 'required|array',
                'data_da_manutencao' => 'required|date',
                'status_manutencao' => 'required|boolean',
            ]);

            $manutencao = Manutencao::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Manutenção cadastrada com sucesso!',
                'manutencao' => $manutencao
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro de validação.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar a manutenção: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function storeMaintenanceWithReserve(Request $request)
    {
        try {
            $validated = $request->validate([
                'onibus_id' => 'required|exists:onibuses,id',
                'data' => 'required|date',
                'nome_motorista' => 'required|string',
                'rota' => 'required|string',
                'km_atual' => 'required|integer',
                'problema' => 'required|array',
                'data_da_manutencao' => 'required|date',
                'status_manutencao' => 'required|boolean',
                'reserva_onibus_id' => 'nullable|exists:onibuses,id',
            ]);

            $maintenance = Manutencao::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Manutenção registrada com sucesso!',
                'data' => $maintenance,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao registrar manutenção.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function listMaintenanceWithReserve()
    {
        try {
            $maintenances = Manutencao::with('onibus', 'reservaOnibus')
                ->whereNotNull('reserva_onibus_id')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Manutenções com ônibus reserva listadas com sucesso.',
                'data' => $maintenances,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao listar manutenções.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Exibe a manutenção pelo ID.
     */
    public function show($id)
    {
        try {
            $manutencao = Manutencao::with('onibus')->findOrFail($id);
            return response()->json([
                'status' => true,
                'manutencao' => $manutencao
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Manutenção não encontrada.',
            ], 404);
        }
    }

    /**
     * Atualiza uma manutenção existente.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'onibus_id' => 'required|exists:onibuses,id',
                'data' => 'required|date',
                'nome_motorista' => 'required|string',
                'rota' => 'required|string',
                'km_atual' => 'required|string',
                'problema' => 'required|array',
                'data_da_manutencao' => 'required|date',
                'status_manutencao' => 'required|boolean',
            ]);

            $manutencao = Manutencao::findOrFail($id);
            $manutencao->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Manutenção atualizada com sucesso!',
                'manutencao' => $manutencao
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar a manutenção: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Exclui uma manutenção.
     */
    public function destroy($id)
    {
        try {
            $manutencao = Manutencao::findOrFail($id);
            $manutencao->delete();

            return response()->json([
                'status' => true,
                'message' => 'Manutenção excluída com sucesso!'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir a manutenção: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function maintenanceReport()
    {
        try {
            $maintenances = Manutencao::with('onibus', 'reservaOnibus')->get();

            return response()->json([
                'status' => true,
                'message' => 'Relatório de manutenções gerado com sucesso.',
                'data' => $maintenances,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao gerar relatório.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}

