@extends('layouts.master')

@section('content')


@if(session('errors'))
    @if($errors->any())
        @foreach($errors->getMessages() as $this_error)
            <x-layout.alert status="Erro" message="{{$this_error[0]}}" class="danger" />
        @endforeach
    @endif 
@endif

<form method="post" action="{{ route('pessoa.store') }}">
    <x-form.btn_save />
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <label class="form-label">CPF</label>
            <input required type="text" class="form-control cpf" name="cpf" id="cpf">
        </div>
        <div class="col-sm-4">
            <label class="form-label">E-mail</label>
            <input required type="email" class="form-control" name="email" id="email">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="form-label">Nome</label>
            <input required type="text" class="form-control" name="nome" id="nome">
        </div>
        <div class="col-sm-4">
            <label class="form-label">Sobrenome</label>
            <input required type="text" class="form-control" name="sobrenome" id="sobrenome">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="form-label">Data de nascimento</label>
            <input required type="text" class="form-control data" name="data_nascimento" id="data_nascimento">
        </div>
        <div class="col-sm-4">
            <label class="form-label">Gênero</label>
            <select required class="form-control" name="genero" id="genero">
                <option value="">Selecione</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outros">Outros</option>
            </select>
        </div>
    </div>
</form>

@stop