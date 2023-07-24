<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use Exception;
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

        dd($validated);
    }

    public function update(PessoaRequest $request)
    {

    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
