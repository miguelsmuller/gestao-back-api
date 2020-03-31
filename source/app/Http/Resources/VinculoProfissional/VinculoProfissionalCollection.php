<?php

namespace App\Http\Resources\VinculoProfissional;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VinculoProfissionalCollection extends ResourceCollection
{
    public $collects = VinculoProfissionalResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

