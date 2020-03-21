@extends('layouts.app')

@section('title', 'Unidades Escolares')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="accordion">


{{-- Filter --}}
<div class="card">
    <div class="card-header" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">Ações e Filtro</div>

    <div id="collapseFilter" class="collapse show" aria-labelledby="headingOne">
        <div class="card-body">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ URL::route('unidades-escolares.create') }}">Novo Registro</a>
                </li>
            </ul>
        </div>
    </div>
</div>


{{-- Table --}}
<div class="card">
    <div class="card-header" data-toggle="collapse" data-target="#collapseTable" aria-expanded="false" aria-controls="collapseTable">Unidades Escolares</div>

    <div id="collapseTable" class="collapse show" aria-labelledby="headingTwo">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th class="table-light font-weight-normal" scope="col">Nome</th>
                            <th class="table-light font-weight-normal" scope="col">Abreviatura</th>
                            <th class="table-light font-weight-normal" scope="col">INEP</th>
                            <th class="table-light font-weight-normal" scope="col">Localização</th>
                            <th class="table-light font-weight-normal" scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $unidade)
                        <tr>
                            <th class="align-middle"><a href="{{ URL::route('unidades-escolares.edit', $unidade) }}">{{ $unidade->nomeCompleto }}</a></th>
                            <td class="align-middle">{{ $unidade->inep }}</td>
                            <td class="align-middle">{{ $unidade->localizacao }}</td>
                            <td class="align-middle">{{ $unidade->nomeAbreviado }}</td>
                            <td class="align-middle">
                                @if ($unidade->inativo == false)
                                <h5 class="badge badge-success">Ativa</h5>
                                @else
                                <h5 class="badge badge-danger">Inativa</h5>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
</div>
@endsection
