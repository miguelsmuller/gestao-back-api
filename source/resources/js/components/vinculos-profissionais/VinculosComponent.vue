<script>
export default {
    props: [
        "pessoaUnidades",
    ],

    data() { return {} },

    created() {
    },

    mounted() {

    },

    methods: {
        enviarFormulario: function (event) {
            if (event) event.preventDefault()
        },

        inserirVinculo: function(){
            //var vinculo = {firstName:"John", lastName:"Doe", age:50, eyeColor:"blue"};
            //this.pessoa_unidades.vinculos.unshift(vinculo);
        },

        alterarPessoa: function(event){
            console.log(event)
        }
    }
}
</script>
<template>
<form @submit="enviarFormulario" method="post">
    <div class="card">
        <div class="card-header font-weight-bolder">Listagem de Vínculos por Pessoa</div>

        <div class="card-body">
            <!-- PESSOA -->
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="inputFirstname">Pessoa:</label>

                    <select-component
                        name="cirme"
                        placeholder="Selecione uma pessoa"
                        :url="'api/pessoas'"
                        :columnsref="['cirme']"
                        :columnstext="['nomeCompleto','cpf']"
                        >
                    </select-component>
                </div>
            </div>

            <!-- VINCULOS -->
            <div class="form-row">
                <div class="col-sm-12">
                    <div class="list-group">
                        <vinculos-item-component
                        v-for="vinculo in pessoaUnidades.vinculos" :key="vinculo.id">
                        </vinculos-item-component>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button @click="inserirVinculo" class="btn btn-secondary">Novo Vínculo</button>
            <button type="submit" class="btn btn-primary" :disabled="value == null">Salvar registros</button>
        </div>
    </div>
</form>
</template>
