@extends('layouts.app')

@section('title', isset($data->id) ? 'Ano Letivo - ' . $data->nomeCompleto : 'Adicionar Ano Letivo' )

@section('content')
<div class="row">
    <div class="col-md-12">

    @if(isset($data->id))
        {{ Form::model($data, array('route' => array('anos-escolaridades.update', $data), 'method' => 'PUT')) }}
    @else
        {!! Form::open(['route' => 'anos-escolaridades.store', 'method' => 'POST']) !!}
    @endif

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="inline-block">{{ isset($data->id) ? 'Editar - ' . $data->nomeCompleto : 'Adicionar Ano Escolaridade' }}</span>
    </div>

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

@if(isset($data->id))
<div class="form-row">
    <div class="form-group col-sm-3 position-relative">
        <label for="id">Código:</label>
        <input type="text"
        name="anoEscolaridade[id]"
        id="id"
        class="form-control"
        value="{{ $data->id }}"
        readonly>
    </div>
</div>
@endif

{{-- LINHA FORM --}}
<div class="form-row">
    <div class="form-group col-sm-4 position-relative">
        <label for="nomeCompleto">Nome Completo:</label>
        <input type="text"
        id="nomeCompleto"
        name="anoEscolaridade[nomeCompleto]"
        class="form-control {{ $errors->has('nomeCompleto') ? 'is-invalid' : '' }}"
        value="{{ old( 'nomeCompleto', $data->nomeCompleto) }}">

        {{ ($errors->has('nome')) ? $errors->first('nome') : '' }}
    </div>

    <div class="form-group col-sm-3 position-relative">
        <label for="nomeAbreviado">Nome Abreviado:</label>
        <input type="text"
        id="nomeAbreviado"
        name="anoEscolaridade[nomeAbreviado]"
        class="form-control {{ $errors->has('nomeAbreviado') ? 'is-invalid' : '' }}"
        value="{{ old( 'nomeAbreviado', $data->nomeAbreviado) }}">

        {{ ($errors->has('nomeAbreviado')) ? $errors->first('nomeAbreviado') : '' }}
    </div>
</div>

{{-- LINHA FORM --}}
<div class="form-row">
    {{-- INATIVO --}}
    <div class="form-group col-sm-4 position-relative m-0">
        <div class="custom-control custom-switch">
            <input type="checkbox"
            class="custom-control-input"
            id="inativo"
            name="anoEscolaridade[inativo]"
            value="1"
            {{ $data->inativo?' checked':'' }}>

            <label class="custom-control-label" for="inativo">Esse ano de escolaridade foi descontinuado</label>
        </div>
    </div>
</div>

            </div>

            @if(isset($data->id))
            <div class="card-footer">
                <small class="text-muted">Criado: {{ $data->created_at->format('d/m/Y \à\s H:m') }} | Atualizado: {{ $data->updated_at->diffForHumans() }}</small>
            </div>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">Salvar registro</button>
        <a href="{{ URL::route('anos-escolaridades.index') }}" class="btn btn-secondary">Listar Anos Escolaridade</a>
    </div>
</div>

    {!! Form::close() !!}
    </div>
</div>
@endsection
