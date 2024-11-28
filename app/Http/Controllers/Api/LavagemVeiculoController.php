<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LavagemVeiculo;
use Illuminate\Http\Request;

class LavagemVeiculoController extends Controller
{
    /**
     * Listar todas as lavagens.
     */
    public function index()
    {
        try {
            $lavagens = LavagemVeiculo::all();
            return response()->json([
                'status' => true,
                'message' => 'Lavagens listadas com sucesso!',
                'data' => $lavagens
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao listar lavagens: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Criar uma nova lavagem.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'data_envio_solicitacao' => 'required|date',
                'placa_onibus' => 'required|string',
                'nome_motorista' => 'required|string',
                'rota' => 'required|string',
                'km_rota' => 'required|integer',
                'data_lavagem_programada' => 'required|date',
                'data_lavagem_realizada' => 'nullable|date',
                'hora_lavagem' => 'nullable',
                'servicos_realizados' => 'required|string',
                'valor_servico' => 'required|numeric',
                'status_lavagem' => 'required|boolean',
                'data_prevista_proxima_lavagem' => 'nullable|date',
            ]);

            $lavagem = LavagemVeiculo::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Lavagem cadastrada com sucesso!',
                'data' => $lavagem
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro de validação.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar lavagem: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Exibir uma lavagem específica.
     */
    public function show($id)
    {
        try {
            $lavagem = LavagemVeiculo::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Lavagem encontrada!',
                'data' => $lavagem
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar lavagem: ' . $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Atualizar uma lavagem.
     */
    public function update(Request $request, $id)
    {
        try {
            $lavagem = LavagemVeiculo::findOrFail($id);

            $validated = $request->validate([
                'data_envio_solicitacao' => 'nullable|date',
                'placa_onibus' => 'nullable|string',
                'nome_motorista' => 'nullable|string',
                'rota' => 'nullable|string',
                'km_rota' => 'nullable|integer',
                'data_lavagem_programada' => 'nullable|date',
                'data_lavagem_realizada' => 'nullable|date',
                'hora_lavagem' => 'nullable',
                'servicos_realizados' => 'nullable|string',
                'valor_servico' => 'nullable|numeric',
                'status_lavagem' => 'nullable|boolean',
                'data_prevista_proxima_lavagem' => 'nullable|date',
            ]);

            $lavagem->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Lavagem atualizada com sucesso!',
                'data' => $lavagem
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
                'message' => 'Erro ao atualizar lavagem: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Deletar uma lavagem.
     */
    public function destroy($id)
    {
        try {
            $lavagem = LavagemVeiculo::findOrFail($id);
            $lavagem->delete();

            return response()->json([
                'status' => true,
                'message' => 'Lavagem excluída com sucesso!',
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir lavagem: ' . $e->getMessage(),
            ], 500);
        }
    }
}

