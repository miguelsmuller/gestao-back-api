<?php
namespace Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Traits\UseUuid;

class Responsaveis extends Pivot
{
    use UseUuid;

    protected $table = 'vinculos_profissionais';
    protected $primaryKey = ['cirme', 'cirme_aluno'];
    public $incrementing = false;

    public $validacaoRegras = [
        //
    ];

    protected $fillable = [
        'cirme',
        'cirme_aluno',
        'parentesco',
        'responsavel_legal',
        'autorizacao_buscar_aluno',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
