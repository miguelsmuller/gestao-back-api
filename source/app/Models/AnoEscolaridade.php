<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class AnoEscolaridade extends Model
{
    use UseUuid;

    protected $table = 'anos_escolaridades';
    public $incrementing = false;

    public $validacaoRegras = [
        'nome_completo' => [
            'max:60',
            'required',
        ],
        'nome_abreviado' => [
            'max:6',
            'required',
        ],
        'inativo' => [
            'boolean',
            'required',
        ]
    ];

    protected $fillable = [
        'nome_completo',
        'nome_abreviado',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * MANY TO MANY
     */
    public function anosLetivosEscolares(){
        return $this->belongsToMany('Models\AnoLetivoEscolar', 'anos_escolaridades_disponiveis')
        ->using('Models\AnosEscolaridadeDisponivel')
        ->as('AnosEscolaridadeDisponivel')
        ->withTimestamps();
    }
}
