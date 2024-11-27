<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monitora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class MonitoraController extends Controller
{
    // Listar todas as monitoras
    public function index()
    {
        try {
            $monitoras = Monitora::all();
            return response()->json([
                'status' => true,
                'message' => 'Monitoras listadas com sucesso!',
                'data' => $monitoras
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível listar as monitoras!',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Exibir uma monitora específica
    public function show($id)
    {
        try {
            $monitora = Monitora::find($id);
            
            if (!$monitora) {
                return response()->json([
                    'status' => false,
                    'message' => 'Monitora não encontrada!'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Monitora encontrada com sucesso!',
                'data' => $monitora
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível encontrar a monitora!',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Criar uma nova monitora
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome_monitora' => 'required|string',
                'data_nascimento' => 'required|date',
                'cpf_monitora' => 'required|string',
                'endereco' => 'required|string',
                'data_admissao' => 'required|date',
                'tempo_empresa_atual' => 'required|integer',
                'status' => 'required|in:Ativo,Inativo',
                'documentacao_pendente' => 'required|boolean',
                'rota' => 'required|string',
                'itinerario' => 'required|string',
                'km_rota' => 'required|integer',
                'placa_onibus' => 'required|string',
                'curso_monitora_atualizado' => 'required|boolean',
                'validade_curso' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validação falhou!',
                    'errors' => $validator->errors()
                ], 422);
            }

            $monitora = Monitora::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Monitora cadastrada com sucesso!',
                'data' => $monitora
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível cadastrar a monitora!',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Atualizar uma monitora existente
    public function update(Request $request, $id)
    {
        try {
            $monitora = Monitora::find($id);

            if (!$monitora) {
                return response()->json([
                    'status' => false,
                    'message' => 'Monitora não encontrada!'
                ], 404);
            }

            $monitora->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Monitora atualizada com sucesso!',
                'data' => $monitora
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível atualizar a monitora!',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Deletar uma monitora
    public function destroy($id)
    {
        try {
            $monitora = Monitora::find($id);

            if (!$monitora) {
                return response()->json([
                    'status' => false,
                    'message' => 'Monitora não encontrada!'
                ], 404);
            }

            $monitora->delete();

            return response()->json([
                'status' => true,
                'message' => 'Monitora deletada com sucesso!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível deletar a monitora!',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
