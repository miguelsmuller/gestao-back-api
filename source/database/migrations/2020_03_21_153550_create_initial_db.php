<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialDb extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        /* -- -----------------------------------------------------
        -- Table `pessoas`
        -- ----------------------------------------------------- */
        Schema::create('pessoas', function (Blueprint $table) {
            $table->uuid('cirme')->nullable(false);
            $table->primary('cirme');

            $table->string('nomeCompleto', '255')->nullable(false);
            $table->timestampTz('dataNascimento')->nullable(false);
            $table->string('cpf', '11')->nullable(true)->unique();
            $table->enum('sexo', ['masculino', 'feminino'])->nullable(true);
            $table->boolean('falecido')->nullable(false)->default(true);
            $table->timestamps();
        });

        /* -- -----------------------------------------------------
        -- Table `cargos`
        -- ----------------------------------------------------- */
        Schema::create('cargos', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();

            $table->string('nome', '60')->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        /* -- -----------------------------------------------------
        -- Table `unidadesEscolares`
        -- ----------------------------------------------------- */
        Schema::create('unidadesEscolares', function (Blueprint $table) {
            $table->unsignedBigInteger('inep')->nullable(false);
            $table->primary(['inep']);

            $table->string('nomeCompleto', '60')->nullable(false);
            $table->string('nomeAbreviado', '30')->nullable(false);
            $table->enum('localizacao', ['urbana', 'rural'])->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        /* -- -----------------------------------------------------
        -- Table `vinculosProfissionais`
        -- ----------------------------------------------------- */
        Schema::create('vinculosProfissionais', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->primary('id');

            $table->uuid('cirme')->nullable(false);
            $table->unsignedBigInteger('inep')->nullable(false);
            $table->unsignedBigInteger('idCargo')->nullable(false);
            $table->string('matricula', '12')->nullable(true);
            $table->timestampTz('dataInicio')->nullable(true);
            $table->timestampTz('dataTermino')->nullable(true);
            $table->enum('regimeContratacao', ['Estatutário', 'Seletivo', 'Estagiário'])->nullable(false);
            $table->enum('turno', ['Integral', 'Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();

            $table->index(['cirme']);
            $table->index(['inep']);
            $table->index(['idCargo']);

            $table->foreign('cirme')->references('cirme')->on('pessoas');
            $table->foreign('idCargo')->references('id')->on('cargos');
            $table->foreign('inep')->references('inep')->on('unidadesEscolares');
        });

        /* -- -----------------------------------------------------
        -- Table `anosLetivos`
        -- ----------------------------------------------------- */
        Schema::create('anosLetivos', function (Blueprint $table) {
            $table->unsignedInteger('anoLetivo')->nullable(false);
            $table->primary(['anoLetivo']);

            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        /* -- -----------------------------------------------------
        -- Table `anosLetivosEscolares`
        -- ----------------------------------------------------- */
        Schema::create('anosLetivosEscolares', function (Blueprint $table) {
            $table->unsignedBigInteger('inep')->nullable(false);
            $table->unsignedInteger('anoLetivo')->nullable(false);
            $table->primary(['inep', 'anoLetivo'], 'inep_anoletivo');

            $table->boolean('inativo')->default(false);
            $table->timestamps();

            $table->index(['inep']);
            $table->index(['anoLetivo']);

            $table->foreign('inep')->references('inep')->on('unidadesEscolares');
            $table->foreign('anoLetivo')->references('anoLetivo')->on('anosLetivos');
        });

        /* -- -----------------------------------------------------
        -- Table `anosEscolaridades`
        -- ----------------------------------------------------- */
        Schema::create('anosEscolaridades', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();

            $table->string('nomeCompleto', '60')->nullable(false);
            $table->string('nomeAbreviado', '6')->nullable(false);
            $table->boolean('inativo')->nullable(true)->default(false);
            $table->timestamps();
        });

        /* -- -----------------------------------------------------
        -- Table `anosEscolaridadesDisponiveis`
        -- ----------------------------------------------------- */
        Schema::create('anosEscolaridadesDisponiveis', function (Blueprint $table) {
            $table->unsignedBigInteger('inep')->nullable(false);
            $table->unsignedInteger('anoLetivo')->nullable(false);
            $table->unsignedBigInteger('idAnoEscolaridade')->nullable(false);
            $table->primary(['inep', 'anoLetivo', 'idAnoEscolaridade'], 'inep_anoletivo_idanoescolaridade');

            $table->timestamps();

            $table->index(['idAnoEscolaridade']);
            $table->index(['inep', 'anoLetivo']);

            $table->foreign(['inep', 'anoLetivo'])->references(['inep', 'anoLetivo'])->on('anosLetivosEscolares');
            $table->foreign('idAnoEscolaridade')->references('id')->on('anosEscolaridades');
        });

        /* -- -----------------------------------------------------
        -- Table `turmas`
        -- ----------------------------------------------------- */
        Schema::create('turmas', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();

            $table->unsignedBigInteger('inep')->nullable(false);
            $table->unsignedInteger('anoLetivo')->nullable(false);
            $table->unsignedBigInteger('idAnoEscolaridade')->nullable(false);
            $table->string('turma', '12');
            $table->enum('turno', ['Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->boolean('inativo')->default(false);
            $table->timestamps();

            $table->foreign(['inep', 'anoLetivo', 'idAnoEscolaridade'])->references(['inep', 'anoLetivo', 'idAnoEscolaridade'])->on('anosEscolaridadesDisponiveis');
        });

        /* -- -----------------------------------------------------
        -- Table `alunos`
        -- ----------------------------------------------------- */
        Schema::create('alunos', function (Blueprint $table) {
            $table->uuid('cirme_aluno')->nullable(false);;
            $table->primary('cirme_aluno');

            $table->unsignedBigInteger('inep')->nullable(true);
            $table->enum('certidaoTipo', ['Integral', 'Matutino', 'Vespertino', 'Noturno'])->nullable(true);
            $table->string('certidaoCampo1', '45')->nullable(true);
            $table->string('certidaoCampo2', '45')->nullable(true);
            $table->string('certidaoCampo3', '45')->nullable(true);
            $table->string('certidaoUF', '2')->nullable(true);
            $table->timestampTz('certidaoEmissao')->nullable(true);
            $table->string('certidaoCartorio', '45')->nullable(true);
            $table->string('cartaoSUS', '45')->nullable(true);
            $table->text('justificaticaFaltaDocumentos')->nullable(true);
            $table->enum('estadoCivil', ['Integral', 'Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->enum('raca', ['Integral', 'Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->enum('nacionalidade', ['Integral', 'Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->enum('religiao', ['Integral', 'Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->string('ocupacao', '120');
            $table->boolean('autorizaUsoImagem')->default(false);
            $table->boolean('saidaLiberada')->default(false);
            $table->timestamps();

            $table->index(['cirme_aluno']);

            $table->foreign('cirme_aluno')->references('cirme')->on('pessoas');
        });

        /* -- -----------------------------------------------------
        -- Table `matriculas`
        -- ----------------------------------------------------- */
        Schema::create('matriculas', function (Blueprint $table) {
            $table->uuid('idMatricula')->nullable(false);
            $table->primary('idMatricula');

            $table->uuid('cirme_aluno')->nullable(false);
            $table->unsignedBigInteger('inep')->nullable(false);
            $table->unsignedInteger('anoLetivo')->nullable(false);
            $table->unsignedBigInteger('idAnoEscolaridade')->nullable(false);
            $table->unsignedBigInteger('idTurma')->nullable(true);
            $table->unsignedInteger('numOrdem')->nullable(true);
            $table->enum('situacao', ['Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->timestamps();

            $table->index(['idTurma']);
            $table->index(['idMatricula']);
            $table->index(['inep', 'anoLetivo', 'idAnoEscolaridade']);
            $table->index(['cirme_aluno']);

            $table->foreign('idTurma')->references('id')->on('turmas');
            $table->foreign('inep', 'anoLetivo', 'idAnoEscolaridade')->references('inep', 'anoLetivo', 'idAnoEscolaridade')->on('anosEscolaridadesDisponiveis');
            $table->foreign('cirme_aluno')->references('cirme_aluno')->on('alunos');

        });

        /* -- -----------------------------------------------------
        -- Table `responsaveis`
        -- ----------------------------------------------------- */
        Schema::create('responsaveis', function (Blueprint $table) {
            $table->uuid('cirme_aluno')->nullable(false);
            $table->uuid('cirme')->nullable(false);
            $table->primary(['cirme_aluno', 'cirme'], 'cirme_aluno_cirme');

            $table->enum('parentesco', ['Matutino', 'Vespertino', 'Noturno'])->nullable(false);
            $table->boolean('responsavelLegal')->nullable(true)->default(false);
            $table->boolean('autorizacaoBuscarAluno')->nullable(true)->default(true);
            $table->timestamps();

            $table->index(['cirme_aluno']);
            $table->index(['cirme']);

            $table->foreign('cirme')->references('cirme')->on('pessoas');
            $table->foreign('cirme_aluno')->references('cirme_aluno')->on('alunos');
        });

        /* -- -----------------------------------------------------
        -- Table `contatos`
        -- ----------------------------------------------------- */
        Schema::create('contatos', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();

            $table->uuid('cirme')->nullable(false);
            $table->string('descricaoContato', '45')->nullable(false);
            $table->enum('tipoContato', ['telefone', 'email'])->nullable(false);
            $table->string('valorContato', '120')->nullable(false);
            $table->timestamps();

            $table->index(['cirme']);

            $table->foreign('cirme')->references('cirme')->on('pessoas');
        });

        /* -- -----------------------------------------------------
        -- Table `enderecos`
        -- ----------------------------------------------------- */
        Schema::create('enderecos', function (Blueprint $table) {
            $table->uuid('cirme')->nullable(false);
            $table->primary('cirme');

            $table->string('cep', '8')->nullable(true);
            $table->string('municipio', '60')->nullable(true);
            $table->string('distrito', '60')->nullable(true);
            $table->string('bairro', '60')->nullable(true);
            $table->string('logradouro', '255')->nullable(true);
            $table->string('numero', '45')->nullable(true);
            $table->string('complemento', '45')->nullable(true);
            $table->timestamps();

            $table->index(['cirme']);

            $table->foreign('cirme')->references('cirme')->on('pessoas')->onDelete('cascade');;
        });

        /* -- -----------------------------------------------------
        -- Table `fichasMedicas`
        -- ----------------------------------------------------- */
        Schema::create('fichasMedicas', function (Blueprint $table) {
            $table->uuid('cirme_aluno')->nullable(false);
            $table->primary('cirme_aluno');

            $table->string('grupoSanguineo', '2');
            $table->string('fatorRH', '1');
            $table->boolean('fazAcompanhamentoMedico');
            $table->boolean('fazAcompanhamentoPisicologico');
            $table->boolean('fazAcompanhamentoPisiquiatrico');
            $table->string('fazUsoMedicacao', '255');
            $table->string('possuiRestricaoAtividadeFisica', '255');
            $table->string('alergicoMedicamentos', '255');
            $table->string('alergicoAlimentos', '255');
            $table->string('possuiDoencaCongenita', '255');
            $table->string('possuiPlanoSaude', '255');
            $table->boolean('sofreuFraturaTrauma');
            $table->boolean('contraiuCaxumba');
            $table->boolean('contraiuSarampo');
            $table->boolean('contraiuRubeula');
            $table->boolean('contraiuCatapora');
            $table->boolean('contraiuCoqueluche');
            $table->boolean('contraiuOutrasDoencas');
            $table->boolean('epiletico');
            $table->boolean('emofilico');
            $table->boolean('hipertenso');
            $table->boolean('asmatico');
            $table->boolean('diabetico');
            $table->boolean('dependenteInsulina');
            $table->timestamps();

            $table->index(['cirme_aluno']);

            $table->foreign('cirme_aluno')->references('cirme_aluno')->on('alunos');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->uuid('cirme')->nullable(false)->unique();
            $table->boolean('inativo')->nullable(true)->default(false);

            $table->index(['cirme']);

            $table->foreign('cirme')->references('cirme')->on('pessoas');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('fichasMedicas');
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('contatos');
        Schema::dropIfExists('responsaveis');
        Schema::dropIfExists('matriculas');
        Schema::dropIfExists('alunos');
        Schema::dropIfExists('turmas');
        Schema::dropIfExists('anosEscolaridadesDisponiveis');
        Schema::dropIfExists('anosEscolaridades');
        Schema::dropIfExists('anosLetivosEscolares');
        Schema::dropIfExists('anosLetivos');
        Schema::dropIfExists('vinculosProfissionais');
        Schema::dropIfExists('unidadesEscolares');
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('pessoas');
    }
}
