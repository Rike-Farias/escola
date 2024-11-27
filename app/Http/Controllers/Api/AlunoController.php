<?php

namespace App\Http\Controllers\Api;

use App\Models\Aluno;
use App\Imports\AlunosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AlunoController extends Controller{


    // Método para listar todos os alunos
    public function index(){
        $alunos = Aluno::all();

        return response()->json([
            'status' => true,
            'alunos' => $alunos,
        ], 200);

        if (!$alunos) {
            return response()->json(['error' => 'A lista de alunos nao pode ser exibida'], 404);
        }
    }

    // Método para exibir um aluno por ID
    public function show($id){
        $aluno = Aluno::find($id); // Busca o aluno pelo ID
        
        if (!$aluno) {
            return response()->json(['error' => 'Aluno não encontrado'], 404);
        }

        return response()->json([
            'status' => true,
            'aluno' => $aluno,
        ], 200);
    }

    // Método para criar um novo aluno
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'nome_aluno' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'cpf_aluno' => 'required|string', // Validação CPF
            'sexo' => 'required|string|max:1',
            'nome_pai' => 'nullable|string|max:255',
            'nome_mae' => 'nullable|string|max:255',
            'telefone_responsavel' => 'nullable|string|max:20',
            'etnia' => 'nullable|string|max:50',
            'status' => 'required|string|max:20',
            'bolsa_familia' => 'nullable|boolean',
            'status_transporte' => 'nullable|boolean',
            'numero_matricula_rede' => 'nullable|string|max:20',
            'numero_inep' => 'nullable|string|max:20',
            'deficiencia' => 'nullable|string|max:255',
            'etapa_ensino' => 'nullable|string|max:50',
            'turma' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:255',
            'tipo_vinculo' => 'nullable|string|max:50',
            'sigla_concessionaria_energia' => 'nullable|string|max:10',
            'unidade_consumidora' => 'nullable|string|max:50',
            'turno' => 'nullable|string|max:20',
            'rota' => 'nullable|string|max:50',
        ]);

        // Se a validação falhar, retorna os erros
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Não foi possivel realizar o cadastro do aluno!',
            ], 400);
        }

        // Cria o aluno no banco de dados
        $aluno = Aluno::create($request->all());

        return response()->json([
            'message' => 'Aluno cadastrado com sucesso!',
            'aluno' => $aluno
        ], 201);
    }

    // Método para atualizar um aluno
    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id); // Busca o aluno pelo ID
        
        // Se o aluno não for encontrado, retorna erro 404
        if (!$aluno) {
            return response()->json(['error' => 'Aluno não encontrado'], 404);
        }

        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'nome_aluno' => 'sometimes|required|string|max:255',
            'data_nascimento' => 'sometimes|required|date',
            'cpf_aluno' => 'required|string', // Validação CPF
            'sexo' => 'sometimes|required|string|max:1',
            'nome_pai' => 'nullable|string|max:255',
            'nome_mae' => 'nullable|string|max:255',
            'telefone_responsavel' => 'nullable|string|max:20',
            'etnia' => 'nullable|string|max:50',
            'status' => 'sometimes|required|string|max:20',
            'bolsa_familia' => 'nullable|boolean',
            'status_transporte' => 'nullable|boolean',
            'numero_matricula_rede' => 'nullable|string|max:20',
            'numero_inep' => 'nullable|string|max:20',
            'deficiencia' => 'nullable|string|max:255',
            'etapa_ensino' => 'nullable|string|max:50',
            'turma' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:255',
            'tipo_vinculo' => 'nullable|string|max:50',
            'sigla_concessionaria_energia' => 'nullable|string|max:10',
            'unidade_consumidora' => 'nullable|string|max:50',
            'turno' => 'nullable|string|max:20',
            'rota' => 'nullable|string|max:50',
        ]);

        // Se a validação falhar, retorna os erros
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Atualiza os dados do aluno
        $aluno->update($request->all());

        return response()->json([
            'message' => 'Aluno atualizado com sucesso!',
            'aluno' => $aluno
        ], 200);
    }

    // Método para excluir um aluno
    public function destroy($id)
    {
        $aluno = Aluno::find($id); // Busca o aluno pelo ID
        
        // Se o aluno não for encontrado, retorna erro 404
        if (!$aluno) {
            return response()->json(['error' => 'Aluno não encontrado'], 404);
        }

        // Exclui o aluno
        $aluno->delete();

        return response()->json([
            'status' => true,
            'message' => 'Aluno excluído com sucesso!',
        ], 200);
    }

    public function importar(Request $request){
        // Validação do arquivo
        $request->validate([
            'arquivo' => 'required|file|mimes:xlsx,csv',
        ]);

        // Recupera o arquivo enviado
        $file = $request->file('arquivo');

        // Identifica a extensão do arquivo
        $extension = $file->getClientOriginalExtension();
        Log::info('Extensão do arquivo: ' . $extension);

        // Verifica o tipo de arquivo
        if ($extension == 'xlsx') {
            Log::info('O arquivo é do tipo XLSX.');
        } elseif ($extension == 'csv') {
            Log::info('O arquivo é do tipo CSV.');
        } else {
            return response()->json(['message' => 'Tipo de arquivo inválido.'], 400);
        }

        // Armazenando o arquivo na pasta 'private/temp'
        $path = $file->store('private/temp');
        
        // Log para verificar o caminho temporário
        Log::info('Arquivo armazenado no caminho: ' . $path);

        // Caminho absoluto para o arquivo armazenado
        $filePath = storage_path('app/' . $path); // Caminho correto do arquivo

        // Verificando se o arquivo realmente existe no diretório
        // if (!file_exists($filePath)) {
        //     Log::error('O arquivo não foi encontrado no diretório. Caminho: ' . $filePath);
        //     return response()->json(['message' => 'O arquivo não foi encontrado no diretório.'], 404);
        // }

        // Log para verificar o caminho do arquivo
        Log::info('Caminho do arquivo: ' . $filePath);

        // Importando os dados com o caminho correto
        try {
            Excel::import(new AlunosImport, $filePath);
        } catch (\Exception $e) {
            Log::error('Erro ao importar o arquivo: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao importar o arquivo.'], 500);
        }

        return response()->json(['message' => 'Planilha importada com sucesso!'], 200);
    }
}
