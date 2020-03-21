<?php
namespace Models\Base;

use Illuminate\Database\Eloquent\Model;

class AnoLetivo extends Model
{
    protected $table = 'anosLetivos';
    protected $primaryKey = 'anoLetivo';
    public $incrementing = false;

    protected $fillable = [
        'anoLetivo',
        'inativo'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
