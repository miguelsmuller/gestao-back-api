<div class="accordion" id="sideBarMenuAccordion">
    <div class="card">
        <a href="/" class="card-header text-decoration-none text-reset" id="administracao-header">Dashboard</a>
    </div>

    <div class="card">
        <div class="card-header" id="administracao-header" type="button" data-toggle="collapse" data-target="#administracao" aria-expanded="true" aria-controls="administracao">Administração</div>

        <div id="administracao" class="collapse" aria-labelledby="administracao-header" data-parent="#sideBarMenuAccordion">
            <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <a href="{{route('anos-letivos.index')}}" class="list-group-item list-group-item-action">Anos Letivos</a>
                <a href="#" class="list-group-item list-group-item-action disabled" aria-disabled="true">Usuários do Sistema</a>
            </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="cadastros-header" type="button" data-toggle="collapse" data-target="#cadastros" aria-expanded="true" aria-controls="cadastros">Cadastros</div>

        <div id="cadastros" class="collapse" aria-labelledby="cadastros-header" data-parent="#sideBarMenuAccordion">
            <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <a href="{{route('pessoas.index')}}" class="list-group-item list-group-item-action">Pessoas</a>
            </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="educacional-header" type="button" data-toggle="collapse" data-target="#educacional" aria-expanded="false" aria-controls="educacional">Educacional</div>

        <div id="educacional" class="collapse" aria-labelledby="educacional-header" data-parent="#sideBarMenuAccordion">
            <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <a href="{{route('unidades-escolares.index')}}" class="list-group-item list-group-item-action">Unidades Escolares</a>
                <a href="{{route('anos-escolaridades.index')}}" class="list-group-item list-group-item-action">Anos de Escolaridade</a>
                <a href="#" class="list-group-item list-group-item-action disabled">Trumas</a>
                <a href="#" class="list-group-item list-group-item-action disabled">Alunos</a>
                <a href="#" class="list-group-item list-group-item-action disabled">Matrículas</a>
                <a href="#" class="list-group-item list-group-item-action disabled">Enturmação</a>
            </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="trabalhista-header" type="button" data-toggle="collapse" data-target="#trabalhista" aria-expanded="false" aria-controls="trabalhista">Trabalhista</div>

        <div id="trabalhista" class="collapse" aria-labelledby="trabalhista-header" data-parent="#sideBarMenuAccordion">
            <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <a href="{{route('cargos.index')}}" class="list-group-item list-group-item-action">Cargos</a>
                <a href="{{route('listVinculo')}}" class="list-group-item list-group-item-action disabled">Vínculos Profissionais</a>
            </div>

            </div>
        </div>
    </div>
</div>


