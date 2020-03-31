<?php

namespace App\Http\Resources\AnoEscolaridade;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AnoEscolaridadeCollection extends ResourceCollection
{
    public $collects = AnoEscolaridadeResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

