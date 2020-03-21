<?php
namespace Models\Trabalhista;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class VinculoProfissional extends Model
{
    use UseUuid;

    protected $table = 'vinculosProfissionais';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'ID',
        'cirme',
        'idCargo',
        'inep',
        'matricula',
        'dataInicio',
        'dataTermino',
        'regimeContratacao',
        'turno',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'dataInicio',
        'dataTermino'
    ];
}
