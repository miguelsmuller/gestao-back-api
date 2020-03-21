@extends('layouts.app')

@section('title', isset($data->id) ? 'Cargo - ' . $data->nome : 'Adicionar Cargo' )

@section('content')
<div class="row">
    <div class="col-md-12">

    @if(isset($data->id))
        {{ Form::model($data, array('route' => array('cargos.update', $data->id), 'method' => 'PUT')) }}
    @else
        {!! Form::open(['route' => 'cargos.store', 'method' => 'POST']) !!}
    @endif

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="inline-block">{{ isset($data->id) ? 'Editar - ' . $data->nome : 'Adicionar Ano Cargo' }}</span>
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
        name="cargo[id]"
        id="id"
        class="form-control"
        value="{{ $data->id }}"
        readonly>
    </div>
</div>
@endif

{{-- NOME --}}
<div class="form-row">
    <div class="form-group col-sm-6 position-relative">
        <label for="nomeCompleto">Nome Completo:</label>
        <input type="text"
        id="nome"
        name="cargo[nome]"
        class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
        value="{{ old( 'nome', $data->nome) }}">

        {{ ($errors->has('nome')) ? $errors->first('nome') : '' }}
    </div>
</div>

{{-- INATIVO --}}
<div class="form-group m-0">
    <div class="col-sm-10 custom-control custom-switch">
        <input type="checkbox"
        class="custom-control-input"
        id="inativo"
        name="cargo[inativo]"
        value="1"
        {{$data->inativo?' checked':''}}>

        <label class="custom-control-label" for="inativo">Esse cargo foi descontinuado</label>
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
        <a href="{{ URL::route('cargos.index') }}" class="btn btn-secondary">Listar Cargos</a>
    </div>
</div>

    {!! Form::close() !!}
    </div>
</div>
@endsection
