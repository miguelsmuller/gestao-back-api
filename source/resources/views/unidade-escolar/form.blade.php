@extends('layouts.app')

@section('title', isset($data->inep) ? 'Unidade Escolar - ' . $data->nomeAbreviado : 'Adicionar Unidade Escolar' )

@section('content')
<div class="row">
    <div class="col-md-12">

    @if(isset($data->inep))
        {{ Form::model($data, array('route' => array('unidades-escolares.update', $data->inep), 'method' => 'PUT')) }}
    @else
        {!! Form::open(['route' => 'unidades-escolares.store', 'method' => 'POST']) !!}
    @endif

<div class="card">
    <div class="card-header">{{ isset($data->inep) ? 'Editar - ' . $data->inep . ' - ' . $data->nomeAbreviado : 'Adicionar Unidade Escolar' }}</div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">O formulário não foi preenchido corretamente.</div>
            <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('content') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">

{{-- LINHA FORM --}}
<div class="form-row">
    {{-- INEP --}}
    <div class="form-group col-sm-3">
        <label for="inep">INEP:</label>

        <input type="text"
        id="inep"
        name="unidade[inep]"
        class="form-control {{ $errors->has('inep') ? 'is-invalid' : '' }}"
        value="{{ old( 'unidade.inep', $data->inep) }}">

        {{ ($errors->has('inep')) ? $errors->first('inep') : '' }}
    </div>
</div>

{{-- LINHA FORM --}}
<div class="form-row">
    {{-- NOME --}}
    <div class="form-group col-sm-6">
        <label for="nomeCompleto">Nome Completo:</label>

        <input type="text"
        id="nomeCompleto"
        name="unidade[nomeCompleto]"
        class="form-control {{ $errors->has('nomeCompleto') ? 'is-invalid' : '' }}"
        value="{{ old( 'unidade.nomeCompleto', $data->nomeCompleto) }}">

        {{ ($errors->has('nomeCompleto')) ? $errors->first('nomeCompleto') : '' }}
    </div>

    {{-- ABREVIATURA --}}
    <div class="form-group col-sm-5">
        <label for="nomeAbreviado">Nome Curto:</label>

        <input type="text"
        id="nomeAbreviado"
        name="unidade[nomeAbreviado]"
        class="form-control {{ $errors->has('nomeAbreviado') ? 'is-invalid' : '' }}"
        value="{{ old( 'unidade.nomeAbreviado', $data->nomeAbreviado) }}">

        {{ ($errors->has('nomeAbreviado')) ? $errors->first('nomeAbreviado') : '' }}
    </div>
</div>

{{-- LOCALIZAÇÃO --}}
<div class="form-group row">
    <label for="situacao" class="col-sm-2 col-form-label">Localização:</label>
    <div class="col-sm-10">

        @php
        if (!isset($data->inep)) { $data->localizacao = 'urbana'; }
        @endphp
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio"
                id="localizacao"
                name="unidade[localizacao]"
                value="urbana" {{$data->localizacao == 'urbana'?' checked':''}}> Urbana
            </label>
            <label class="btn btn-secondary">
                <input type="radio"
                id="localizacao"
                name="unidade[localizacao]"
                value="rural" {{$data->localizacao == 'rural'?' checked':''}}> Rural
            </label>
        </div>
    </div>
</div>

{{-- SITUAÇÃO --}}
<div class="form-group row mb-0">
    <label for="inativo" class="col-sm-2 col-form-label">Situação:</label>
    <div class="col-sm-10">

        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio"
                id="inativo"
                name="unidade[inativo]"
                value='0' {{$data->inativo == 0?' checked':''}}> Ativa
            </label>
            <label class="btn btn-secondary">
                <input type="radio"
                id="inativo"
                name="unidade[inativo]"
                value='1' {{$data->inativo == 1?' checked':''}}> Inativa
            </label>
        </div>
    </div>
</div>

            </div>

            @if(isset($data->inep))
            <div class="card-footer">
                <small class="text-muted">Criado: {{ $data->created_at->format('d/m/Y \à\s H:m') }} | Atualizado: {{ $data->updated_at->diffForHumans() }}</small>
            </div>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">Salvar registro</button>
        <a href="{{ URL::route('unidades-escolares.index') }}" class="btn btn-secondary">Listar Unidades</a>
    </div>
</div>

    {!! Form::close() !!}
    </div>
</div>
@endsection
