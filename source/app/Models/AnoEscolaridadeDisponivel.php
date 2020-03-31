<?php
namespace Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AnoEscolaridadeDisponivel extends Pivot
{
    protected $table = 'anos_escolaridades_disponiveis';
    protected $primaryKey = ['unidade_escolar_id', 'ano_letivo_id', 'ano_escolaridade_id'];
    public $incrementing = false;

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
