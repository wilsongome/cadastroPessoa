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

            $pessoas = Pessoa::paginate(10);
            return view('pessoa.index', ['pessoas' => $pessoas]);
        
        }catch(Exception $e){
            return redirect()->route('pessoa.index', [], 500)->with('exception','Exceção: Erro ao listar os cadastros!');
        }
        
    }

    private function persist(array $parameters): Pessoa|array
    {
        try {
            $parameters['email']            = strtolower($parameters['email']);
            $parameters['nome']             = ucfirst($parameters['nome']);
            $parameters['genero']           = ucfirst($parameters['genero']);
            $parameters['data_nascimento']  = Carbon::createFromFormat('d/m/Y',$parameters['data_nascimento'])->format('Y-m-d');
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
            return redirect()->route('pessoa.create', [], 500)->with('exception','Exceção: Dados inválidos!');
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
            $pessoa->nome = ucfirst($validated['nome']);
            $pessoa->sobrenome = $validated['sobrenome'];
            $pessoa->data_nascimento = $validated['data_nascimento'];
            $pessoa->email = strtolower($validated['email']);
            $pessoa->genero = ucfirst($validated['genero']);
            $pessoa->save();
            return redirect()->route('pessoa.edit', ['id' => $pessoa->id])->with('success','Dados alterados!');
        
        } catch (Exception $e) {
            return redirect()->route('pessoa.edit', ['id' => $pessoa->id], 500)->with('exception',"Exceção: Verifique os dados!");
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
            return redirect()->route('pessoa.index')->with('exception','Exceção: Pessoa não existe!');
           }

           $pessoa->data_nascimento = Carbon::parse($pessoa->data_nascimento)->format('d/m/Y');
           return view('pessoa.edit', ['pessoa' => $pessoa]);

        } catch (Exception $e) {
            return redirect()->route('pessoa.index', [], 500)->with('exception','Exceção: Dados inválidos!');
        }
    }

    public function delete(Request $request)
    {
        try {

            $pessoa = Pessoa::find($request->route('id'));
            if(!$pessoa){
                return redirect()->route('pessoa.index')->with('exception','Exceção: Pessoa não existe!');
            }
            $pessoa->delete();
            return redirect()->route('pessoa.index')->with('success','Pessoa removida!');

         } catch (Exception $e) {
             return redirect()->route('pessoa.index', [], 500)->with('exception','Exceção: Pessoa não existe!');
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
