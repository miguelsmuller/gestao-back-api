@extends('layouts.app')

@section('title', isset($data->cirme) ? $data->nomeCompleto : 'Adicionar Pessoa' )

@section('content')
<div class="row">
    <div class="col-md-12">

    @if(isset($data->cirme))
        {{ Form::model($data, array('route' => array('pessoas.update', $data), 'method' => 'PUT')) }}
    @else
        {!! Form::open(['route' => 'pessoas.store', 'method' => 'POST']) !!}
    @endif

<div class="card">
    <div class="card-header">{{ isset($data->cirme) ? 'Editar - ' . $data->nomeCompleto : 'Adicionar Pessoa' }}</div>

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


@if(isset($data->cirme))
{{-- LINHA FORM --}}
<div class="form-row">

    <div class="form-group col-sm-4 position-relative">
        <label for="cirme">CIRME:</label>

        <input type="text"
        id="cirme"
        name="pessoa[cirme]"
        class="form-control"
        value="{{ $data->cirme }}"
        readonly>
    </div>
</div>
@endif


{{-- LINHA FORM --}}
<div class="form-row">
    {{-- NOME --}}
    <div class="form-group col-sm-6 position-relative">
        <label for="nomeCompleto">Nome Completo:</label>
        <input type="text"
        id="nomeCompleto"
        name="pessoa[nomeCompleto]"
        class="form-control {{ $errors->has('nomeCompleto') ? 'is-invalid' : '' }}"
        value="{{ old( 'pessoa.nomeCompleto', $data->nomeCompleto) }}">

        {{ ($errors->has('nomeCompleto')) ? $errors->first('nomeCompleto') : '' }}
    </div>

    {{-- D.NASCIMENTO --}}
    <div class="form-group col-sm-3 position-relative">
        <label for="dataNascimento">D. Nascimento:</label>
        <input type="text"
        id="dataNascimento"
        name="pessoa[dataNascimento]"
        class="form-control {{ $errors->has('dataNascimento') ? 'is-invalid' : '' }}"
        value="{{ old( 'pessoa.dataNascimento', optional($data->dataNascimento)->format('d/m/Y')) }}">

        {{ ($errors->has('dataNascimento')) ? $errors->first('dataNascimento') : '' }}
    </div>

    {{-- CPF --}}
    <div class="form-group col-sm-3 position-relative">
        <label for="cpf">CPF:</label>
        <input type="text"
        id="cpf"
        name="pessoa[cpf]"
        class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}"
        value="{{ old( 'pessoa.cpf', $data->cpf) }}">

        {{ ($errors->has('cpf')) ? $errors->first('cpf') : '' }}
    </div>
</div>

{{-- LINHA FORM --}}
<div class="form-row">
    {{-- SEXO --}}
    <div class="form-group col-auto">
        <label for="sexo">Sexo:</label>
        <div>
            @php
            if (!isset($data->cirme)) { $data->sexo = 'masculino'; }
            @endphp
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio"
                    id="sexo"
                    name="pessoa[sexo]"
                    value="masculino"
                    {{$data->sexo == 'masculino'?' checked':''}}> Masculino
                </label>

                <label class="btn btn-secondary">
                    <input type="radio"
                    id="sexo"
                    name="pessoa[sexo]"
                    value="feminino"
                    {{$data->sexo == 'feminino'?' checked':''}}> Feminino
                </label>
            </div>
        </div>
    </div>

    {{-- FALECIDO --}}
    <div class="form-group col-sm-3">
        <div class="d-flex flex-column h-100 align-items-stretch justify-content-center">
            <div class="custom-control custom-switch">
                <input type="checkbox"
                class="custom-control-input"
                id="falecido"
                name="pessoa[falecido]"
                value="1"
                {{$data->falecido?' checked ':''}}>

                <label class="custom-control-label" for="falecido">Essa pessoa se encontra falecida</label>
            </div>
        </div>
    </div>
</div>


<h4 class="pt-4">Endereços</h4>
{{-- LINHA FORM --}}
<div class="form-row">
    {{-- CEP --}}
    <div class="form-group col-sm-3 position-relative">
        <label for="cep">CEP:</label>
        <input type="text"
        id="endereco[cep]"
        name="endereco[cep]"
        class="form-control {{ $errors->has('') ? 'is-invalid' : '' }}"
        value="{{ old('endereco.cep', (isset($data->endereco)) ? $data->endereco->cep : '') }}">

        {{ ($errors->has('cep')) ? $errors->first('cep') : '' }}
    </div>

    {{-- MUNICIPIO --}}
    <div class="form-group col-sm-3 position-relative">
        <label for="endereco[municipio]">Municipio:</label>
        <input type="text"
        class="form-control"
        name="endereco[municipio]"
        value="">

        {{ ($errors->has('endereco[municipio]')) ? $errors->first('endereco[municipio]') : '' }}
    </div>

    {{-- DISTRITO --}}
    <div class="form-group col-sm-3 position-relative">
        <label for="endereco[distrito]">Distrito:</label>
        <input type="text" class="form-control" name="endereco[distrito]" value="">

        {{ ($errors->has('endereco[distrito]')) ? $errors->first('endereco[distrito]') : '' }}
    </div>

    {{-- BAIRRO --}}
    <div class="form-group col-sm-3 position-relative">
        <label for="endereco[bairro]">Bairro:</label>
        <input type="text" class="form-control" name="endereco[bairro]" value="">

        {{ ($errors->has('endereco[bairro]')) ? $errors->first('endereco[bairro]') : '' }}
    </div>
</div>

{{-- LINHA FORM --}}
<div class="form-row">
    {{-- LOGRADOURO --}}
    <div class="form-group col-sm-6 position-relative">
        <label for="endereco[logradouro]">Logradouro:</label>
        <input type="text" class="form-control" name="endereco[logradouro]" value="">

        {{ ($errors->has('endereco[logradouro]')) ? $errors->first('endereco[logradouro]') : '' }}
    </div>

    {{-- NUMERO --}}
    <div class="form-group col-sm-2 position-relative">
        <label for="endereco[numero]">Numero:</label>
        <input type="text" class="form-control" name="endereco[numero]" value="">

        {{ ($errors->has('endereco[numero]')) ? $errors->first('endereco[numero]') : '' }}
    </div>

    {{-- COMPLEMENTO --}}
    <div class="form-group col-sm-4 position-relative">
        <label for="endereco[complemento]">Complemento:</label>
        <input type="text" class="form-control" name="endereco[complemento]" value="">

        {{ ($errors->has('endereco[complemento]')) ? $errors->first('endereco[complemento]') : '' }}
    </div>
</div>

<h4 class="pt-4">Contatos</h4>
<div class="form-group m-0">
</div>
            </div>

            @if(isset($data->cirme))
            <div class="card-footer">
                <small class="text-muted">Criado: {{ $data->created_at->format('d/m/Y \à\s H:m') }} | Atualizado: {{ $data->updated_at->diffForHumans() }}</small>
            </div>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary">Salvar pessoa</button>
        <a href="{{ URL::route('pessoas.index') }}" class="btn btn-secondary">Listar Anos Letivos</a>
    </div>
</div>

    {!! Form::close() !!}
    </div>
</div>
@endsection
