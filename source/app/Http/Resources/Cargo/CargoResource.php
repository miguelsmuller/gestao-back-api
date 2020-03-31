<?php

namespace App\Http\Resources\Cargo;

use Illuminate\Http\Resources\Json\JsonResource;

class CargoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'nome'       => $this->nome,
            'inativo'    => $this->inativo,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
