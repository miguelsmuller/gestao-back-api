<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class Cargo extends Model
{
    use UseUuid;

    protected $table = 'cargos';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $validacaoRegras = [
        'nome' => [
            'max:60',
            'required',
        ],
        'inativo' => [
            'boolean',
            'required',
        ]
    ];

    protected $fillable = [
        'nome',
        'inativo',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * MANY TO MANY
     */
    public function pessoas(){
        return $this->belongsToMany('Models\Pessoa', 'vinculos_profissionais', 'id', 'id_cargo')
        ->using('Models\VinculoProfissional')
        ->as('VinculoProfissional')
        ->withTimestamps();
    }

    public function unidadesEscolares(){
        return $this->belongsToMany('Models\UnidadeEscolar', 'vinculos_profissionais', 'inep', 'inep')
        ->using('Models\VinculoProfissional')
        ->as('VinculoProfissional')
        ->withTimestamps();
    }
}
