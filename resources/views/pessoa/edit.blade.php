@extends('layouts.master')

@section('content')

@if(session('success'))
    <x-layout.alert status="Success" message="{{session('success')}}" class="success" />
@endif

@if(session('errors'))
    @if($errors->any())
        @foreach($errors->getMessages() as $this_error)
            <x-layout.alert status="Erro" message="{{$this_error[0]}}" class="danger" />
        @endforeach
    @endif 
@endif

@if(session('exception'))
    <x-layout.alert status="Erro" message="{{session('exception')}}" class="danger" />
@endif

<form method="post" action="{{ route('pessoa.update', ['id' => $pessoa->id]) }}">
    <x-form.btn_save route="{{ route('pessoa.edit', ['id' => $pessoa->id]) }}" label="Atualizar"/>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-sm-4">
            <label class="form-label">CPF</label>
            <input required type="text" class="form-control cpf" name="cpf" id="cpf" value="{{$pessoa->cpf}}">
        </div>
        <div class="col-sm-4">
            <label class="form-label">E-mail</label>
            <input required type="email" class="form-control" name="email" id="email" value="{{$pessoa->email}}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="form-label">Nome</label>
            <input required type="text" class="form-control" name="nome" id="nome" value="{{$pessoa->nome}}">
        </div>
        <div class="col-sm-4">
            <label class="form-label">Sobrenome</label>
            <input required type="text" class="form-control" name="sobrenome" id="sobrenome" value="{{$pessoa->sobrenome}}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="form-label">Data de nascimento</label>
            <input required type="text" class="form-control data" name="data_nascimento" id="data_nascimento" value="{{$pessoa->data_nascimento}}">
        </div>
        <div class="col-sm-4">
            <label class="form-label">Gênero</label>
            <select required class="form-control" name="genero" id="genero">
                <option value="">Selecione</option>
                <option {{$pessoa->genero == 'Masculino' ? 'selected': null}} value="Masculino">Masculino</option>
                <option {{$pessoa->genero == 'Feminino' ? 'selected': null}} value="Feminino">Feminino</option>
                <option {{$pessoa->genero == 'Outros' ? 'selected': null}} value="Outros">Outros</option>
            </select>
        </div>
    </div>
</form>

@stop