@extends('layouts.app')

@section('title', 'Anos Letivos')

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
                    <a class="nav-link active" href="{{ URL::route('anos-letivos.create') }}">Novo Registro</a>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-header" data-toggle="collapse" data-target="#collapseTable" aria-expanded="false" aria-controls="collapseTable">Anos Letivos</div>

    <div id="collapseTable" class="collapse show" aria-labelledby="headingTwo">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th class="table-light font-weight-normal" scope="col">Ano</th>
                            <th class="table-light font-weight-normal" scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $anoLetivo)
                        <tr>
                            <th class="align-middle"><a href="{{ URL::route('anos-letivos.edit', $anoLetivo->anoLetivo) }}">{{ $anoLetivo->anoLetivo }}</a></th>
                            <td class="align-middle">
                                @if ($anoLetivo->inativo == false)
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
