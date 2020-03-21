<?php
namespace Models\Educacional;

use Illuminate\Database\Eloquent\Model;

class UnidadeEscolar extends Model
{
    protected $table = 'unidadesEscolares';
    protected $primaryKey = 'inep';
    public $incrementing = false;

    protected $fillable = [
        'inep',
        'nomeCompleto',
        'nomeAbreviado',
        'localizacao',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
