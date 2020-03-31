<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class AnoLetivo extends Model
{
    use UseUuid;

    protected $table = 'anos_letivos';
    public $incrementing = false;

    public $validacaoRegras = [
        'ano_letivo' => [
            'size:4',
            'required',
        ],
        'inativo' => [
            'boolean',
            'required',
        ]
    ];

    protected $fillable = [
        'ano_letivo',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * MANY TO MANY
     */
    public function unidadesEscolares(){
        return $this->belongsToMany('Models\UnidadeEscolar', 'anos_letivos_escolares')
        ->using('Models\AnoLetivoEscolar')
        ->as('anoLetivoEscolar')
        ->withTimestamps();
    }
}
