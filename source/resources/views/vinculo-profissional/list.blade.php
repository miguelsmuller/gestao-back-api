@extends('layouts.app')

@section('title', 'Vinculos Profissionais')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="accordion">


{{-- Filter --}}
<div class="card">
    <div class="card-header font-weight-bolder" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">Ações e Filtro</div>

    <div id="collapseFilter" class="collapse show" aria-labelledby="headingOne">
        <div class="card-body">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ URL::route('viewVinculo') }}">Novo Registro</a>
                </li>
            </ul>
        </div>
    </div>
</div>


{{-- Table --}}
<div class="card">
    <div class="card-header font-weight-bolder" data-toggle="collapse" data-target="#collapseTable" aria-expanded="false" aria-controls="collapseTable">Vinculos Profissionais</div>

    <div id="collapseTable" class="collapse show" aria-labelledby="headingTwo">
        <div class="card-body">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Unidade Escolar</th>
                        <th scope="col">Função</th>
                        <th scope="col">Regime</th>
                        <th scope="col">D. Inicio</th>
                        <th scope="col">D. Término</th>
                        <th scope="col">Situação</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vinculos as $vinculo)
                    <tr>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>

                        <td><a href="{{ URL::route('viewVinculo', [$vinculo->cirme, $vinculo->inep, $vinculo->idCargo]) }}" class="btn btn-light">Editar</a></td>
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
@endsection
