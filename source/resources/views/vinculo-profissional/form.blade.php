@extends('layouts.app')

@section('title', isset($vinculos->cirme) ? 'Cargo - ' . $vinculos->nomeCompleto : 'Adicionar Vínculo' )

@section('content')
<div class="row">
    <div class="col-md-12">
        <vinculos-component
        :pessoa-unidades={{  json_encode($vinculos) }}>
        </vinculos-component>
    </div>
</div>
@endsection
