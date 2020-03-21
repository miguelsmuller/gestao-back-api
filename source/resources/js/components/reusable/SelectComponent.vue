<script>
import select2 from 'select2'

export default {
    props: {
        url: String,
        columnsref: Array,
        columnstext: Array,
    },
    data: function() {
        return {
            value: this.value
        };
    },
    mounted() {
        let vm = this;

        let options = {
            theme: 'bootstrap4',
            minimumInputLength: 3,
            placeholder: this.$attrs.placeholder,
            ajax: {
                delay: 400,
                url: window.location.origin + '/' +  this.url,
                data: function (params) {
                    var query = {
                        search: params.term,
                    }
                    return query;
                },
                processResults: function (response) {
                    response.data = response.data.map(item => {
                        item.id = item[vm.columnsref[0]];
                        return item;
                    });

                    response.data = response.data.map(item => {
                        item.text = item[vm.columnstext[0]] + ' - ' + item[vm.columnstext[1]];
                        return item;
                    });

                    return {
                        results: response.data
                    };
                },
                cache: false
            },
            "language": {
                errorLoading: function () {
                    return 'Os resultados não puderam ser carregados.';
                },
                noResults: function () {
                    return 'Nenhum resultado encontrado';
                },
                searching: function () {
                    return 'Buscando…';
                },
                inputTooShort: function (args) {
                    var remainingChars = args.minimum - args.input.length;

                    var message = 'Digite ' + remainingChars + ' ou mais caracteres';

                    return message;
                },
            },
        };

        $(vm.$el)
        .select2( options )
        .on( "select2:select", function() {
            vm.value = vm.$el.value;
        });
    }
}
</script>
<template>
    <select :url="url" :columnsref="[columnsref]" :columnstext="[columnstext]" class="form-control">
        <option></option>
    </select>
</template>
