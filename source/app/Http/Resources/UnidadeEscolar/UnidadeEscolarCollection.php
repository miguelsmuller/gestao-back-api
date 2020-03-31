<?php

namespace App\Http\Resources\UnidadeEscolar;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UnidadeEscolarCollection extends ResourceCollection
{
    public $collects = UnidadeEscolarResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

