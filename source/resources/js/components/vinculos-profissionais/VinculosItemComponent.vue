<script>
export default {
    props: [
    ],

    data() {
        return {}
    },

    created() {
    },

    mounted() {
    },

    methods: {
    }
}
</script>
<template>
<div class="list-group-item">
    <div class="form-row">
        <!-- INEP -->
        <div class="col-sm-4">
            <label for="inep">INEP:</label>
            <select-component
                id="inep"
                name="vinculo[inep]"
                placeholder="Seleciona uma Unidade Escolar"
                url="api/unidades-escolares"
                :columnsref="['inep']"
                :columnstext="['nomeCompleto']"
                >
            </select-component>
        </div>

        <!-- CARGO -->
        <div class="col-sm-4">
            <label for="cargo">Cargo:</label>
            <select-component
                id="cargo"
                name="vinculo[cargo]"
                placeholder="Seleciona um cargo"
                url="api/cargos"
                :columnsref="['id']"
                :columnstext="['nome']"
                >
            </select-component>
        </div>

        <!-- D.INICIO -->
        <div class="form-group col-sm-2 position-relative">
            <label for="dataInicio">D. Inicio:</label>
            <input type="text"
            id="dataInicio"
            name="vinculo[dataInicio]"
            class="form-control"
            value="">
        </div>

        <!-- D.TERMINO -->
        <div class="form-group col-sm-2 position-relative">
            <label for="dataTermino">D. Término:</label>
            <input type="text"
            id="dataTermino"
            name="vinculo[dataTermino]"
            class="form-control"
            value="">
        </div>
    </div>

    <div class="form-row">
        <!-- REGIME CONTRATAÇÃO -->
        <div class="form-group col-sm-3 position-relative">
            <label for="regimeContratacao">Regima de Contratação:</label>
            <input type="text"
            id="regimeContratacao"
            name="vinculo[regimeContratacao]"
            class="form-control"
            value="">
        </div>

        <!-- MATRÍCULA -->
        <div class="form-group col-sm-3 position-relative">
            <label for="matricula">Matrícula:</label>
            <input type="text"
            id="matricula"
            name="vinculo[matricula]"
            class="form-control"
            value="">
        </div>

        <!-- TURNO -->
        <div class="form-group col-sm-3 position-relative">
            <label for="turno">Turno:</label>
            <input type="text"
            id="turno"
            name="vinculo[turno]"
            class="form-control"
            value="">
        </div>
    </div>

    <div class="form-row">
        <!-- INATIVO -->
        <div class="form-group col-sm-12  m-0">
            <div class="custom-control custom-switch">
                <input type="checkbox"
                class="custom-control-input"
                id="inativo"
                name="cargo[inativo]"
                value="1">

                <label class="custom-control-label" for="inativo">Esse vínculo profissional foi descontinuado</label>
            </div>
        </div>
    </div>
</div>
</template>
