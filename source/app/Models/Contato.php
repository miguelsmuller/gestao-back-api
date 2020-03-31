<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class Contato extends Model
{
    use UseUuid;

    protected $table = 'contatos';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $validacaoRegras = [
        //
    ];

    protected $fillable = [
        'cirme',
        'descricao_contato',
        'tipo',
        'valor_contato'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * ONE TO MANY INVERSE
     */
    public function pessoa(){
        return $this->belongsTo('Models\Pessoa');
    }
}
