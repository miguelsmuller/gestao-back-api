<?php

namespace App\Http\Resources\Endereco;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EnderecoCollection extends ResourceCollection
{
    public $collects = EnderecoResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

