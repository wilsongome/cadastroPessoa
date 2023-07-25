<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PessoaController extends Controller
{

    public function index()
    {
        try{
            $pessoas = Pessoa::all();
            return view('pessoa.index', $pessoas);
        }catch(Exception $e){
            return redirect()->route('pessoas.index')->with('error','Erro ao listar os cadastros!');
        }
        
    }

    public function store(PessoaRequest $request)
    {
        $validated = $request->validated();
        $validated['data_nascimento'] = Carbon::parse($validated['data_nascimento'])->format('Y-m-d');
        $pessoa = Pessoa::create($validated);
        return view('pessoa/'.$pessoa->id.'/edit', $pessoa);
    }

    public function update(PessoaRequest $request)
    {

    }

    public function create()
    {
        return view('pessoa.create');
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
