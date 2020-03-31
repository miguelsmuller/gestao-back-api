<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class UnidadeEscolar extends Model
{
    use UseUuid;

    protected $table = 'unidades_escolares';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $validacaoRegras = [
        'inep' => [
            'required'
        ],
        'nome_completo' => 'required|max:60',
        'nome_abreviado' => 'required|max:30',
        'localizacao' => 'in:urbana,rural',
        'inativo' => 'boolean'
    ];

    protected $fillable = [
        'inep',
        'nome_completo',
        'nome_abreviado',
        'localizacao',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * MANY TO MANY
     */
    public function anosLetivos(){
        return $this->belongsToMany('Models\AnoLetivo', 'anos_letivos_escolares')
        ->using('Models\AnoLetivoEscolar')
        ->as('anoLetivoEscolar')
        ->withTimestamps();
    }

    public function pessoas(){
        return $this->belongsToMany('Models\Pessoa', 'vinculos_profissionais')
        ->using('Models\VinculoProfissional')
        ->as('VinculoProfissional')
        ->withTimestamps();
    }

    public function cargos(){
        return $this->belongsToMany('Models\Cargo', 'vinculos_profissionais')
        ->using('Models\VinculoProfissional')
        ->as('VinculoProfissional')
        ->withTimestamps();
    }
}
