<?php

namespace App\Http\Resources\UnidadeEscolar;

use Illuminate\Http\Resources\Json\JsonResource;

class UnidadeEscolarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'inep'           => $this->inep,
            'nome_completo'  => $this->nome_completo,
            'nome_abreviado' => $this->nome_abreviado,
            'localizacao'    => $this->localizacao,
            'inativo'        => $this->inativo,
            'created_at'     => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'     => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
