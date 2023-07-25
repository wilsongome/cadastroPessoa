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
        @foreach ($pessoas as $pessoa)
        <tr>
            <td>{{$pessoa->id}}</td>
            <td>{{$pessoa->cpf}}</td>
            <td>{{$pessoa->nome}} {{$pessoa->sobrenome}}</td>
            <td>{{$pessoa->email}}</td>
            <td>{{Carbon::parse($pessoa->data_nascimento)->format('d/m/Y');}}</td>
            <td>{{$pessoa->genero}}</td>
            <td>
                <a href="/pessoa/{{$pessoa->id}}/edit">
                    <i class="fas fa-edit fa-lg" style="color: green"></i>
                </a>
            </td>
            <td>
                <form method="post" action="/pessoa/{{$pessoa->id}}"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete"><i class="fas fa-trash-alt" style="color: red"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
        

@stop