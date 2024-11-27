<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotoristaController extends Controller
{
    // Método para criar um novo motorista
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_motorista' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'cpf_motorista' => 'required|string|size:14', // CPF como string
            'endereco' => 'required|string|max:255',
            'registro_cnh' => 'required|string|max:20',
            'categoria_cnh' => 'required|string|max:5',
            'validade_habilitacao' => 'required|date',
            'data_admissao' => 'required|date',
            'status' => 'required|in:Ativo,Inativo',
            'rota' => 'required|string|max:255',
            'itinerario' => 'required|string|max:255',
            'km_rota' => 'required|integer',
            'placa_onibus' => 'required|string|max:10',
            'curso_condutor_atualizado' => 'required|boolean',
            'data_validade_curso' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => false,
                'message' => 'Não foi possivel cadastrar o motorista! Tente mais tarde!',
            ], 422);
        }

        $motorista = Motorista::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Motorista cadastrado com sucesso!',
            'motorista' => $motorista
        ], 201);
    }

    // Método para listar todos os motoristas
    public function index()
    {
        $motoristas = Motorista::all();
        return response()->json($motoristas);
    }

    // Método para mostrar um motorista específico
    public function show($id)
    {
        $motorista = Motorista::find($id);

        if (!$motorista) {
            return response()->json(['message' => 'Motorista não encontrado'], 404);
        }

        return response()->json($motorista);
    }

    // Método para atualizar os dados de um motorista
    public function update(Request $request, $id)
    {
        $motorista = Motorista::find($id);

        if (!$motorista) {
            return response()->json([
                'status' => false,
                'message' => 'Motorista não encontrado',
            ], 404);
        }

        $motorista->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Motorista atualizado com sucesso!',
            'motorista' => $motorista
        ], 200);
    }

    // Método para deletar um motorista
    public function destroy($id)
    {
        $motorista = Motorista::find($id);

        if (!$motorista) {
            return response()->json([
                'status' => false,
                'message' => 'Motorista não encontrado',
            ], 404);
        }

        $motorista->delete();

        return response()->json([
            'status' => true,
            'message' => 'Motorista deletado com sucesso!',
        ], 200);
    }
}

