<?php
namespace Models\Base;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class Pessoa extends Model
{
    use UseUuid;

    protected $table = 'pessoas';
    protected $primaryKey = 'cirme';
    public $incrementing = false;

    protected $fillable = [
        'nomeCompleto',
        'dataNascimento',
        'cpf',
        'sexo',
        'falecido'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'dataNascimento'
    ];

    public function user()
    {
        return $this->hasOne('Models\Auth\User', 'cirme', 'cirme');
    }

    public function endereco()
    {
        return $this->hasOne('Models\Base\Endereco', 'cirme', 'cirme');
    }
}
