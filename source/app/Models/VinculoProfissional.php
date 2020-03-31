<?php
namespace Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Traits\UseUuid;

class VinculoProfissional extends Pivot
{
    use UseUuid;

    protected $table = 'vinculos_profissionais';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $validacaoRegras = [
        'cirme' => [
            'required',
        ],
        'inep' => [
            'required',
        ],
        'id_cargo' => [
            'required',
        ],
        'matricula' => [
            'max:12',
        ],
        'data_inicio' => [
            'date',
        ],
        'data_termino' => [
            'date',
        ],
        'regime_contratacao' => [
            'in:estatutario,seletivo,estagiario',
        ],
        'turno' => [
            'in:integral,matutino,vespertino,noturno',
        ],
        'inativo' => [
            'boolean',
        ]
    ];

    protected $fillable = [
        'id',
        'cirme',
        'id_cargo',
        'inep',
        'matricula',
        'data_inicio',
        'data_termino',
        'regime_contratacao',
        'turno',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'data_inicio',
        'data_termino'
    ];
}
