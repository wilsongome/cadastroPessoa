<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PessoaTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_redirecionando_pagina_inicial(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_rota_pessoa_index(): void
    {
        $response = $this->get('/pessoa');

        $response->assertStatus(200);
    }

    public function test_rota_pessoa_edit(): void
    {
        $response = $this->get('/pessoa/1/edit');
        $status = ($response->status() == 200 || (session('exception') && session('exception') == "Exceção: Pessoa não existe!"));
        $this->assertTrue($status);
    }

    public function test_rota_pessoa_delete(): void
    {
        $response = $this->delete('/pessoa/1');
        $status = (session('success') || (session('exception') && session('exception') == "Exceção: Pessoa não existe!"));
        $this->assertTrue($status);
    }

    public function test_pessoa_store(): void
    {
        $response = $this->post('/pessoa',[
            "cpf" => "353.705.190-56",
            "email" =>  "wilsongome@gmail.com", 
            "data_nascimento" =>  "06/05/1977",
            "nome" =>  "Wilson", 
            "sobrenome" =>  "Gomes",
            "genero" =>  "Masculino"
        ]);

        $sucesso = session('success') ? true : false;
        $this->assertTrue($sucesso, "Rota store não salvou");
    }

    public function test_pessoa_update(): void
    {
        $response = $this->put('/pessoa/1',[
            "cpf" => "353.705.190-56",
            "email" =>  "wilsongome@gmail.com", 
            "data_nascimento" =>  "06/05/1977",
            "nome" =>  "Wilson", 
            "sobrenome" =>  "Gomes",
            "genero" =>  "Masculino"
        ]);

        $sucesso = (session('success') || (session('exception') && session('exception') == "Exceção: Pessoa não existe!"));
        $this->assertTrue($sucesso, "Rota update não salvou");
    }

    public function test_api_cadastra_pessoa(): void
    {
        $response = $this->post('/api/cadastro',[
            "cpf" => "353.705.190-56",
            "email" =>  "wilsongome@gmail.com", 
            "data_nascimento" =>  "06/05/1977",
            "nome" =>  "Wilson", 
            "sobrenome" =>  "Gomes",
            "genero" =>  "Masculino"
        ]);

        $response->assertStatus(201);
    }
}
