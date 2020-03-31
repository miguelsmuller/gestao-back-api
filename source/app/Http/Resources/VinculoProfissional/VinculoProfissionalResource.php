<?php

namespace App\Http\Resources\VinculoProfissional;

use Illuminate\Http\Resources\Json\JsonResource;

class VinculoProfissionalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'cirme'              => $this->cirme,
            'inep'               => $this->inep,
            'id_cargo'           => $this->id_cargo,
            'matricula'          => $this->matricula,
            'data_inicio'        => $this->data_inicio->format('Y-m-d'),
            'data_termino'       => $this->data_termino->format('Y-m-d'),
            'regime_contratacao' => $this->regime_contratacao,
            'turno'              => $this->turno,
            'inativo'            => $this->inativo,
            'created_at'         => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'         => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
