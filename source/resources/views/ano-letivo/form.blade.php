@extends('layouts.app')

@section('title', isset($data->anoLetivo) ? 'Ano Letivo - ' . $data->anoLetivo : 'Adicionar Ano Letivo' )

@section('content')
<div class="row">
    <div class="col-md-12">

    @if(isset($data->anoLetivo))
        {{ Form::model($data, array('route' => array('anos-letivos.update', $data), 'method' => 'PUT')) }}
    @else
        {!! Form::open(['route' => 'anos-letivos.store', 'method' => 'POST']) !!}
    @endif

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="inline-block">{{ isset($data->anoLetivo) ? 'Editar - ' . $data->anoLetivo : 'Adicionar Ano Letivo' }}</span>
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

{{-- LINHA FORM --}}
<div class="form-row">
    {{-- ANO LETIVO --}}
    <div class="form-group col-sm-3 position-relative">
        <label for="anoLetivo">Ano Letivo:</label>

        <input type="text"
        id="anoLetivo"
        name="anoLetivo[anoLetivo]"
        class="form-control"
        value="{{ $data->anoLetivo }}">

        {{ ($errors->has('anoLetivo')) ? $errors->first('anoLetivo') : '' }}
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
            name="anoLetivo[inativo]"
            value="1"
            {{ $data->inativo?' checked':'' }}>

            <label class="custom-control-label" for="inativo">Esse ano letivo foi descontinuado</label>
        </div>
    </div>
</div>

            </div>

            @if(isset($data->anoLetivo))
            <div class="card-footer">
                <small class="text-muted">Criado: {{ $data->created_at->format('d/m/Y \à\s H:m') }} | Atualizado: {{ $data->updated_at->diffForHumans() }}</small>
            </div>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">Salvar registro</button>
        <a href="{{ URL::route('anos-letivos.index') }}" class="btn btn-secondary">Listar Anos Letivos</a>
    </div>
</div>

    {!! Form::close() !!}
    </div>
</div>
@endsection
