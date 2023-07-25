<?php

namespace App\Http\Controllers;


use App\Http\Requests\PessoaRequest;
use App\Http\Requests\PessoaRequestApi;
use App\Models\Pessoa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PessoaController extends Controller
{

    public function index()
    {
        try{

            $pessoas = Pessoa::all();
            return view('pessoa.index', ['pessoas' => $pessoas]);
        
        }catch(Exception $e){
            return redirect()->route('pessoa.index')->with('exception','Exceção: Erro ao listar os cadastros!');
        }
        
    }

    private function persist(array $parameters): Pessoa|array
    {
        try {

            $parameters['data_nascimento'] = Carbon::createFromFormat('d/m/Y',$parameters['data_nascimento'])->format('Y-m-d');
            $pessoa = Pessoa::create($parameters);
            return $pessoa;
        
        } catch (Exception $e) {
            return [];
        }
        
    }

    public function store(PessoaRequest $request)
    {
        try {

            $validated = $request->validated();
            $pessoa = $this->persist($validated);

            if(!$pessoa){
                return redirect()->route('pessoa.create')->with('exception','Exceção: Dados inválidos!');
            }

            return redirect()->route('pessoa.edit', ['id' => $pessoa->id])->with('success','Cadastro realizado!');
        
        } catch (Exception $e) {
            return redirect()->route('pessoa.create')->with('exception','Exceção: Dados inválidos!');
        }
    }

    public function update(PessoaRequest $request)
    {
        try {

            $validated = $request->validated();
            $pessoa = Pessoa::find($request->route('id'));

            if(!$pessoa){
                return redirect()->route('pessoa.index')->with('exception',"Exceção: Pessoa não existe!");
            }

            $validated['data_nascimento'] = Carbon::createFromFormat('d/m/Y',$validated['data_nascimento'])->format('Y-m-d');
            $pessoa->cpf = $validated['cpf'];
            $pessoa->nome = $validated['nome'];
            $pessoa->sobrenome = $validated['sobrenome'];
            $pessoa->data_nascimento = $validated['data_nascimento'];
            $pessoa->email = $validated['email'];
            $pessoa->genero = $validated['genero'];
            $pessoa->save();
            return redirect()->route('pessoa.edit', ['id' => $pessoa->id])->with('success','Dados alterados!');
        
        } catch (Exception $e) {
            return redirect()->route('pessoa.edit', ['id' => $pessoa->id])->with('exception',"Exceção: Verifique os dados!");
        }
    }

    public function create()
    {
        return view('pessoa.create');
    }

    public function edit(Request $request)
    {
        try {

           $pessoa = Pessoa::find($request->route('id'));
           if(!$pessoa){
            return redirect()->route('pessoa.index')->with('exception','Exceção: Pessoa não encontrada!');
           }

           $pessoa->data_nascimento = Carbon::parse($pessoa->data_nascimento)->format('d/m/Y');
           return view('pessoa.edit', ['pessoa' => $pessoa]);

        } catch (Exception $e) {
            return redirect()->route('pessoa.index')->with('exception','Exceção: Dados inválidos!');
        }
    }

    public function delete(Request $request)
    {
        try {

            $pessoa = Pessoa::find($request->route('id'));
            $pessoa->delete();
            return redirect()->route('pessoa.index')->with('success','Pessoa removida!');

         } catch (Exception $e) {
             return redirect()->route('pessoa.index')->with('exception','Exceção: Pessoa não encontrada!');
         }
    }

    public function storeApi(PessoaRequestApi $request)
    {
        try{
            
            $validated = $request->validated();
            $pessoa = $this->persist($validated);
            return response()->json($pessoa, 201);

        }catch(Exception $e){
            return response()->json(['message'=>"Dados inválidos!"], 500);
        }
    }
}
