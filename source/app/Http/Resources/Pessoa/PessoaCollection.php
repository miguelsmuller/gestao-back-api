<?php

namespace App\Http\Resources\Pessoa;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PessoaCollection extends ResourceCollection
{
    public $collects = PessoaResource::class;

    public function toArray($request){
        return parent::toArray($request);
    }
}

