<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialDb extends Migration
{
    public function up(){
        Schema::create('pessoas', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->string('nome_completo', '255')->nullable(false);
            $table->string('telefone', '60')->nullable(true);
            $table->string('email', '60')->nullable(true);
            $table->timestampTz('data_nascimento')->nullable(false);
            $table->string('cpf', '11')->nullable(true)->unique();
            $table->enum('sexo', ['masculino', 'feminino'])->nullable(true);
            $table->timestamps();
        });

        Schema::create('cargos', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->string('nome', '60')->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        Schema::create('unidades_escolares', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary(['id']);

            $table->unsignedBigInteger('inep')->nullable(false);
            $table->string('nome_completo', '60')->nullable(false);
            $table->string('nome_abreviado', '30')->nullable(false);
            $table->enum('localizacao', ['urbana', 'rural'])->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        Schema::create('vinculos_profissionais', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->uuid('pessoa_id')->nullable(false);
            $table->uuid('unidade_escolar_id')->nullable(false);
            $table->uuid('cargo_id')->nullable(false);
            $table->string('matricula', '12')->nullable(true);
            $table->timestampTz('data_inicio')->nullable(true);
            $table->timestampTz('data_termino')->nullable(true);
            $table->enum('regime_contratacao', ['estatutario', 'seletivo', 'estagiario'])->nullable(false);
            $table->enum('turno', ['integral', 'matutino', 'vespertino', 'noturno'])->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();

            $table->index(['pessoa_id'], 'fk_pessoas_idx');
            $table->index(['unidade_escolar_id'], 'fk_unidades_escolares_idx');
            $table->index(['cargo_id'], 'fk_cargos_idx');

            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('unidade_escolar_id')->references('id')->on('unidades_escolares');
        });

        Schema::create('anos_letivos', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->unsignedInteger('ano_letivo')->nullable(false)->unique();

            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        Schema::create('anos_letivos_escolares', function (Blueprint $table) {
            $table->uuid('unidade_escolar_id')->nullable(false);
            $table->uuid('ano_letivo_id')->nullable(false);
            $table->primary(['unidade_escolar_id', 'ano_letivo_id'], 'anos_letivos_escolares_id');

            $table->boolean('inativo')->default(false);
            $table->timestamps();

            $table->index(['unidade_escolar_id'], 'fk_unidades_escolares_idx');
            $table->index(['ano_letivo_id'], 'fk_anos_letivos_idx');

            $table->foreign('unidade_escolar_id')->references('id')->on('unidades_escolares');
            $table->foreign('ano_letivo_id')->references('id')->on('anos_letivos');
        });

        Schema::create('anos_escolaridades', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->string('nome_completo', '60')->nullable(false);
            $table->string('nome_abreviado', '6')->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        Schema::create('anos_escolaridades_disponiveis', function (Blueprint $table) {
            $table->uuid('unidade_escolar_id')->nullable(false);
            $table->uuid('ano_letivo_id')->nullable(false);
            $table->uuid('ano_escolaridade_id')->nullable(false);
            $table->primary(['unidade_escolar_id', 'ano_letivo_id', 'ano_escolaridade_id'], 'anos_escolaridades_disponiveis_id');

            $table->timestamps();

            $table->index(['unidade_escolar_id', 'ano_letivo_id'], 'fk_anos_letivos_escolares_idx');
            $table->index(['ano_escolaridade_id'], 'fk_anos_escolaridades_idx');

            $table->foreign(['unidade_escolar_id', 'ano_letivo_id'], 'anos_letivos_escolares_id')->references(['unidade_escolar_id', 'ano_letivo_id'])->on('anos_letivos_escolares');
            $table->foreign('ano_escolaridade_id')->references('id')->on('anos_escolaridades');
        });

        Schema::create('turmas', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->uuid('unidade_escolar_id')->nullable(false);
            $table->uuid('ano_letivo_id')->nullable(false);
            $table->uuid('ano_escolaridade_id')->nullable(false);
            $table->string('turma', '12');
            $table->enum('turno', ['Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->boolean('inativo')->default(false);
            $table->timestamps();

            $table->foreign(['unidade_escolar_id', 'ano_letivo_id', 'ano_escolaridade_id'], 'anos_escolaridades_disponiveis_id')->references(['unidade_escolar_id', 'ano_letivo_id', 'ano_escolaridade_id'])->on('anos_escolaridades_disponiveis');
        });

        Schema::create('alunos', function (Blueprint $table) {
            $table->uuid('aluno_id')->nullable(false);;
            $table->primary('aluno_id');

            $table->unsignedBigInteger('inep')->nullable(true);
            $table->enum('certidao_tipo', ['nascimento.novo', 'nascimento.antigo', 'casamento.novo', 'casamento.antigo'])->nullable(true);
            $table->string('certidao_campo_1', '32')->nullable(true);
            $table->string('certidao_campo_2', '8')->nullable(true);
            $table->string('certidao_campo_3', '4')->nullable(true);
            $table->string('certidao_uf', '2')->nullable(true);
            $table->timestampTz('certidao_emissao')->nullable(true);
            $table->string('certidao_cartorio', '45')->nullable(true);
            $table->string('cartao_sus', '45')->nullable(true);
            $table->text('justificatica_falta_documentos')->nullable(true);
            $table->enum('zona_residencia', ['urbana', 'rural'])->nullable(false);
            $table->enum('localizacao_diferenciada', ['assentamento', 'indigena', 'quilombo', 'nenhum'])->nullable(false);
            $table->enum('estado_civil', ['solteira', 'casada', 'separado', 'divorciado', 'viuvo'])->nullable(false);
            $table->enum('raca', ['amarelo', 'branco', 'indigena', 'pardo', 'preto', 'naodeclarado'])->nullable(false);
            $table->enum('nacionalidade', ['brasileiro', 'naturalizado', 'estrangeiro'])->nullable(false);
            $table->string('religiao', '50')->nullable(false);
            $table->string('ocupacao', '60');
            $table->boolean('autoriza_uso_imagem')->default(false);
            $table->boolean('saida_liberada')->default(false);
            $table->timestamps();

            $table->index(['aluno_id'], 'fk_pessoas_idx');

            $table->foreign('aluno_id')->references('id')->on('pessoas');
        });

        Schema::create('matriculas', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->uuid('aluno_id')->nullable(false);
            $table->uuid('turma_id')->nullable(true);
            $table->uuid('unidade_escolar_id')->nullable(false);
            $table->uuid('ano_letivo_id')->nullable(false);
            $table->uuid('ano_escolaridade_id')->nullable(false);
            $table->unsignedInteger('num_ordem')->nullable(true);
            $table->enum('situacao', ['Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->timestamps();

            $table->index(['aluno_id'], 'fk_alunos_idx');
            $table->index(['turma_id'], 'fk_turmas_idx');
            $table->index(['unidade_escolar_id', 'ano_letivo_id', 'ano_escolaridade_id'], 'fk_anos_escolaridades_disponiveis_idx');


            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreign('aluno_id')->references('aluno_id')->on('alunos');
            $table->foreign('unidade_escolar_id', 'ano_letivo_id', 'ano_escolaridade_id', 'anos_escolaridades_disponiveis_id')->references('unidade_escolar_id', 'ano_letivo_id', 'ano_escolaridade_id')->on('anos_escolaridades_disponiveis');

        });

        Schema::create('responsaveis', function (Blueprint $table) {
            $table->uuid('aluno_id')->nullable(false);
            $table->uuid('responsavel_id')->nullable(false);
            $table->primary(['aluno_id', 'responsavel_id'], 'al_re_id');

            $table->enum('parentesco', ['Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->boolean('responsavel_legal')->nullable(true)->default(false);
            $table->boolean('autorizacao_buscar_aluno')->nullable(true)->default(true);
            $table->timestamps();

            $table->index(['aluno_id'], 'fk_alunos_idx');
            $table->index(['responsavel_id'], 'fk_pessoas_idx');

            $table->foreign('responsavel_id')->references('id')->on('pessoas');
            $table->foreign('aluno_id')->references('aluno_id')->on('alunos');
        });

        Schema::create('contatos', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->uuid('pessoa_id')->nullable(false);
            $table->string('descricao_contato', '45')->nullable(false);
            $table->enum('tipo_contato', ['telefone', 'email'])->nullable(false);
            $table->string('valor_contato', '120')->nullable(false);
            $table->timestamps();

            $table->index(['pessoa_id'], 'fk_pessoas_idx');

            $table->foreign('pessoa_id')->references('id')->on('pessoas');
        });

        Schema::create('enderecos', function (Blueprint $table) {
            $table->uuid('pessoa_id')->nullable(false);
            $table->primary('pessoa_id');

            $table->string('cep', '8')->nullable(true);
            $table->string('municipio', '60')->nullable(true);
            $table->string('distrito', '60')->nullable(true);
            $table->string('bairro', '60')->nullable(true);
            $table->string('logradouro', '255')->nullable(true);
            $table->string('numero', '45')->nullable(true);
            $table->string('complemento', '45')->nullable(true);
            $table->timestamps();

            $table->index(['pessoa_id'], 'fk_pessoas_idx');

            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade');;
        });

        Schema::create('fichas_medicas', function (Blueprint $table) {
            $table->uuid('aluno_id')->nullable(false);
            $table->primary('aluno_id');

            $table->string('grupo_sanguineo', '2');
            $table->string('fator_rh', '1');
            $table->boolean('faz_acompanhamento_medico');
            $table->boolean('faz_acompanhamento_pisicologico');
            $table->boolean('faz_acompanhamento_pisiquiatrico');
            $table->string('faz_uso_medicacao', '255');
            $table->string('possui_restricao_atividade_fisica', '255');
            $table->string('alergico_medicamentos', '255');
            $table->string('alergico_alimentos', '255');
            $table->string('possui_doenca_congenita', '255');
            $table->string('possui_planoSaude', '255');
            $table->boolean('sofreu_fratura_trauma');
            $table->boolean('contraiu_caxumba');
            $table->boolean('contraiu_sarampo');
            $table->boolean('contraiu_rubeula');
            $table->boolean('contraiu_catapora');
            $table->boolean('contraiu_coqueluche');
            $table->boolean('contraiu_outras_doencas');
            $table->boolean('epiletico');
            $table->boolean('emofilico');
            $table->boolean('hipertenso');
            $table->boolean('asmatico');
            $table->boolean('diabetico');
            $table->boolean('dependente_insulina');
            $table->timestamps();

            $table->index(['aluno_id'], 'fk_alunos_idx');

            $table->foreign('aluno_id')->references('aluno_id')->on('alunos');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->uuid('pessoa_id')->nullable(false)->unique();

            $table->index(['pessoa_id']);

            $table->foreign('pessoa_id')->references('id')->on('pessoas');
        });
    }

    public function down(){
        Schema::dropIfExists('users');
        Schema::dropIfExists('fichas_medicas');
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('contatos');
        Schema::dropIfExists('responsaveis');
        Schema::dropIfExists('matriculas');
        Schema::dropIfExists('alunos');
        Schema::dropIfExists('turmas');
        Schema::dropIfExists('anos_escolaridades_disponiveis');
        Schema::dropIfExists('anos_escolaridades');
        Schema::dropIfExists('anos_letivos_escolares');
        Schema::dropIfExists('anos_letivos');
        Schema::dropIfExists('vinculos_profissionais');
        Schema::dropIfExists('unidades_escolares');
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('pessoas');
    }
}
