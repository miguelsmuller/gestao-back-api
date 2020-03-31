<?php

namespace App\Http\Resources\AnoEscolaridade;

use Illuminate\Http\Resources\Json\JsonResource;

class AnoEscolaridadeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'nome_completo'  => $this->nome_completo,
            'nome_abreviado' => $this->nome_abreviado,
            'inativo'        => $this->inativo,
            'created_at'     => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'     => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
