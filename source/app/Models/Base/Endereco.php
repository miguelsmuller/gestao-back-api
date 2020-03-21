<?php
namespace Models\Base;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'cirme';
    public $incrementing = false;

    protected $fillable = [
        'cirme',
        'cep',
        'municipio',
        'distrito',
        'bairro',
        'logradouro',
        'numero',
        'complemento'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('Models\Base\Pessoa', 'cirme', 'cirme');
    }
}
