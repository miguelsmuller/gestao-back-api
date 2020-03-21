<?php
namespace Models\Educacional;

use Illuminate\Database\Eloquent\Model;

class AnoEscolaridade extends Model
{
    protected $table = 'anosEscolaridades';

    protected $fillable = [
        'nomeCompleto',
        'nomeAbreviado',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
