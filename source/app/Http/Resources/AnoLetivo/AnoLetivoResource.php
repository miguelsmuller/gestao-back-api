<?php

namespace App\Http\Resources\AnoLetivo;

use Illuminate\Http\Resources\Json\JsonResource;

class AnoLetivoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ano_letivo' => $this->ano_letivo,
            'inativo'    => $this->inativo,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
