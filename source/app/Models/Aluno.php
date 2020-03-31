<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    protected $primaryKey = 'aluno_id';
    public $incrementing = false;

    public $validacaoRegras = [
        'inep' => [
            'max:25',
        ],
        'certidao_tipo' => [
            'in:nascimento.novo,nascimento.antigo,casamento.novo,casamento.antigo'
        ],
        'certidao_campo_1' => [
            'max:32'
        ],
        'certidao_campo_2' => [
            'max:8'
        ],
        'certidao_campo_3' => [
            'max:4',
        ],
        'certidao_uf' => [
            'size:2',
        ],
        'certidao_emissao' => [
            'date',
        ],
        'certidao_cartorio' => [
            'min:5',
            'max:45'
        ],
        'cartao_sus' => [
            'min:5',
            'max:45',
        ],
        'justificatica_falta_documentos' => [
            'max:500',
        ],
        'estado_civil' => [
            'in:solteiro,casads,separado,divorciado,viuvo',
        ],
        'raca' => [
            'in:amarelo,branco,indigena,pardo,preto,naodeclarado',
        ],
        'nacionalidade' => [
            'in:brasileiro,naturalizado,estrangeiro',
        ],
        'religiao' => [
            'min:5',
            'max:50',
        ],
        'ocupacao' => [
            'min:5',
            'max:60',
        ],
        'autoriza_uso_imagem' => [
            'boolean',
            'required',
        ],
        'saida_liberada' => [
            'boolean',
            'required',
        ],


    ];

    protected $fillable = [
        'aluno_id',
        'inep',
        'certidao_tipo',
        'certidao_campo_1',
        'certidao_campo_2',
        'certidao_campo_3',
        'certidao_uf',
        'certidao_emissao',
        'certidao_cartorio',
        'cartao_sus',
        'justificativa_falta_documento',
        'estado_civil',
        'raca',
        'nacionalidade',
        'religiao',
        'ocupacao',
        'autoriza_uso_image',
        'saida_liberada'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'certidao_emissao'
    ];

    /**
     * MANY TO MANY
     */
    public function responsaveis(){
        return $this->belongsToMany('Models\Aluno', 'responsaveis', 'aluno_id')
        ->using('Models\Responsaveis')
        ->as('VinculoProfissional')
        ->withTimestamps();
    }

    /**
     * ONE TO ONE
     */
    public function pessoa(){
        return $this->belongsTo('Models\Pessoa', 'aluno_id');
    }
}
