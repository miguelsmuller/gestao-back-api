<?php

namespace App\Http\Resources\AnoLetivo;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AnoLetivoCollection extends ResourceCollection
{
    public $collects = AnoLetivoResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

