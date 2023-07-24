@extends('layouts.master')
 
@section('content')

@if(session('error'))
<x-layout.alert status="Error" message="{{session('error')}}" class="danger" />
@endif
@if(session('success'))
<x-layout.alert status="Success" message="{{session('success')}}" class="success" />
@endif

<x-layout.btn_new route="{{ route('pessoa.create') }}"/>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>CPF</th>
            <th>NOME</th>
            <th>E-MAIL</th>
            <th>NASCIMENTO</th>
            <th>GÊNERO</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>203.919.618.88</td>
            <td>Wilson Gomes</td>
            <td>wilsongome@gmail.com</td>
            <td>06/05/1977</td>
            <td>Masculino</td>
            <td>
                <a href="/pessoa/1/edit">
                    <i class="fas fa-edit fa-lg" style="color: green"></i>
                </a>
            </td>
            <td>
                <form method="post" action="/pessoa/1"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete"><i class="fas fa-trash-alt" style="color: red"></i></button>
                </form>
            </td>
        </tr>
    </tbody>
</table>

@stop