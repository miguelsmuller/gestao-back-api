<?php
namespace Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AnoLetivoEscolar extends Pivot
{
    protected $table = 'anos_letivos_escolares';
    protected $primaryKey = ['unidade_escolar_id', 'ano_letivo_id'];
    public $incrementing = false;

    protected $fillable = [
        'unidade_escolar_id',
        'ano_letivo_id',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * MANY TO MANY
     */
    public function anosEscolaridades(){
        return $this->belongsToMany('Models\AnoEscolaridade', 'anos_escolaridades_disponiveis', ['unidade_escolar_id', 'ano_letivo_id'], ['unidade_escolar_id', 'ano_letivo_id'])
        ->using('Models\AnosEscolaridadeDisponivel')
        ->as('AnosEscolaridadeDisponivel')
        ->withTimestamps();
    }
}
