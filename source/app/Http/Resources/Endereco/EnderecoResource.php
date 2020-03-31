<?php

namespace App\Http\Resources\Endereco;

use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'cep'         => $this->cep,
            'municipio'   => $this->municipio,
            'distrito'    => $this->distrito,
            'bairro'      => $this->bairro,
            'logradouro'  => $this->logradouro,
            'numero'      => $this->numero,
            'complemento' => $this->complemento,
        ];
    }
}
