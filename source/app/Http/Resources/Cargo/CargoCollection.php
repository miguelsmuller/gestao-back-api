<?php

namespace App\Http\Resources\Cargo;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CargoCollection extends ResourceCollection
{
    public $collects = CargoResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

