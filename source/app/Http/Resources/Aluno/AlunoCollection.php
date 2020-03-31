<?php

namespace App\Http\Resources\Aluno;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AlunoCollection extends ResourceCollection
{
    public $collects = AlunoResource::class;

    public function toArray($request){
        return parent::toArray($request);
    }
}

