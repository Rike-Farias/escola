<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Onibus;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OnibusController extends Controller
{
    /**
     * Exibe a lista de ônibus.
     */
    public function index()
    {
        try {
            $onibus = Onibus::all();

            return response()->json([
                'status' => true,
                'message' => 'Lista de ônibus carregada com sucesso!',
                'onibus' => $onibus
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao carregar a lista de ônibus: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Armazena um novo ônibus.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'placa_onibus' => 'required|string|unique:onibuses', // Alterado para 'onibuses'
                'onibus_autorizado' => 'required|boolean',
                'data_inicial_da_autorizacao' => 'required|date',
                'vencimento_da_autorizacao' => 'required|date|after_or_equal:data_inicial_da_autorizacao',
                'onibus_licenciado' => 'required|boolean',
                'data_inicial_da_licenca' => 'required|date',
                'vencimento_da_licenca' => 'required|date|after_or_equal:data_inicial_da_licenca',
                'onibus_status' => 'required|boolean',
            ]);

            $validated['dias_para_o_vencimento_da_autorizacao'] = now()->diffInDays($validated['vencimento_da_autorizacao'], false);
            $validated['dias_para_o_vencimento_da_licenca'] = now()->diffInDays($validated['vencimento_da_licenca'], false);

            $onibus = Onibus::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Ônibus cadastrado com sucesso!',
                'onibus' => $onibus
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
                'message' => 'Erro ao cadastrar o ônibus: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Exibe um ônibus específico.
     */
    public function show($id)
    {
        try {
            $onibus = Onibus::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Ônibus encontrado com sucesso!',
                'onibus' => $onibus
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ônibus não encontrado.',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar o ônibus: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Atualiza um ônibus específico.
     */
    public function update(Request $request, $id)
    {
        try {
            $onibus = Onibus::findOrFail($id);

            $validated = $request->validate([
                'placa_onibus' => 'sometimes|string|unique:onibuses,placa_onibus,' . $id,
                'onibus_autorizado' => 'sometimes|boolean',
                'data_inicial_da_autorizacao' => 'sometimes|date',
                'vencimento_da_autorizacao' => 'sometimes|date|after_or_equal:data_inicial_da_autorizacao',
                'onibus_licenciado' => 'sometimes|boolean',
                'data_inicial_da_licenca' => 'sometimes|date',
                'vencimento_da_licenca' => 'sometimes|date|after_or_equal:data_inicial_da_licenca',
                'onibus_status' => 'sometimes|boolean',
            ]);

            if (isset($validated['vencimento_da_autorizacao'])) {
                $validated['dias_para_o_vencimento_da_autorizacao'] = now()->diffInDays($validated['vencimento_da_autorizacao'], false);
            }

            if (isset($validated['vencimento_da_licenca'])) {
                $validated['dias_para_o_vencimento_da_licenca'] = now()->diffInDays($validated['vencimento_da_licenca'], false);
            }

            $onibus->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Ônibus atualizado com sucesso!',
                'onibus' => $onibus
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ônibus não encontrado.',
            ], 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro de validação.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar o ônibus: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove um ônibus específico.
     */
    public function destroy($id)
    {
        try {
            $onibus = Onibus::findOrFail($id);
            $onibus->delete();

            return response()->json([
                'status' => true,
                'message' => 'Ônibus removido com sucesso!',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ônibus não encontrado.',
            ], 404);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao remover o ônibus: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function totalOnibuses()
    {
        try {
            $total = Onibus::count();

            return response()->json([
                'status' => true,
                'message' => 'Total de onibus foi encontrado com sucesso!',
                'total_onibuses' => $total
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter total de ônibus.', 'message' => $e->getMessage()], 500);
        }
    }
    

    public function statusOnibuses()
    {
        try {
            $ativos = Onibus::where('onibus_status', true)->count();
            $inativos = Onibus::where('onibus_status', false)->count();

            return response()->json([
                'ativos' => $ativos,
                'inativos' => $inativos,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao obter status dos ônibus.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function expiredOrNearExpirationLicenseAuthorization()
    {
        try {
            $hoje = Carbon::now();
            $emSeteDias = $hoje->copy()->addDays(7);

            $vencida = Onibus::where('vencimento_da_licenca', '<', $hoje)
                ->orWhere('vencimento_da_autorizacao', '<', $hoje)
            ->get();

            $proximaDeVencer = Onibus::whereBetween('vencimento_da_licenca', [$hoje, $emSeteDias])
                ->orWhereBetween('vencimento_da_autorizacao', [$hoje, $emSeteDias])
            ->get();

            return response()->json([
                'vencida' => $vencida,
                'proxima_de_vencer' => $proximaDeVencer,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao obter dados de vencimento.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

