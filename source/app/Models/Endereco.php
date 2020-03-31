<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'cirme';
    public $incrementing = false;

    public $validacaoRegras = [
        'cep' => 'max:8' ,
        'municipio' => 'max:60',
        'distrito' => 'max:60',
        'bairro' => 'max:60',
        'logradouro' => 'max:255',
        'numero' => 'max:45',
        'complemento' => 'max:45'
    ];

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

    /**
     * ONE TO ONE
     */
    public function pessoa(){
        return $this->belongsTo('Models\Pessoa');
    }
}
