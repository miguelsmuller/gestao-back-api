<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UseUuid;

class Pessoa extends Model
{
    use UseUuid;

    protected $table = 'pessoas';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $validacaoRegras = [
        'nome_completo' => 'required|max:255',
        'data_nascimento' => 'required|date',
        'telefone' => '',
        'email' => '',
        'cpf' => [
            'size:11',
            'nullable'
        ],
        'sexo' => 'in:masculino,feminino',
    ];

    protected $fillable = [
        'nome_completo',
        'data_nascimento',
        'telefone',
        'email',
        'cpf',
        'sexo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'data_nascimento'
    ];

    /**
     * MANY TO MANY
     */
    public function unidadesEscolares(){
        return $this->belongsToMany('Models\UnidadeEscolar', 'vinculos_profissionais')
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

    public function responsaveis(){
        return $this->belongsToMany('Models\Aluno', 'responsaveis')
        ->using('Models\Responsaveis')
        ->as('Responsaveis')
        ->withTimestamps();
    }

    /**
     * ONE TO MANY
     */
    public function contatos(){
        return $this->hasMany('Models\Contato');
    }

    /**
     * ONE TO ONE
     */
    public function endereco(){
      return $this->hasOne('Models\Endereco');
    }

    public function user(){
        return $this->hasOne('Models\User');
    }

    public function aluno(){
        return $this->hasOne('Models\Aluno');
    }
}
