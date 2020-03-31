<?php

namespace App\Http\Resources\Aluno;

use Illuminate\Http\Resources\Json\JsonResource;

class AlunoResource extends JsonResource
{
    public function toArray($request){
        return [
            'inep'                           => $this->inep,
            'certidao_tipo'                  => $this->certidao_tipo,
            'certidao_campo_1'               => $this->certidao_campo_1,
            'certidao_campo_2'               => $this->certidao_campo_2,
            'certidao_campo_3'               => $this->certidao_campo_3,
            'certidao_uf'                    => $this->certidao_uf,
            'certidao_emissao'               => $this->certidao_emissao->format('Y-m-d'),
            'certidao_cartorio'              => $this->certidao_cartorio,
            'cartao_sus'                     => $this->cartao_sus,
            'justificativa_falta_documentos' => $this->justificativa_falta_documentos,
            'estado_civil'                   => $this->estado_civil,
            'raca'                           => $this->raca,
            'nacionalidade'                  => $this->nacionalidade,
            'religiao'                       => $this->religiao,
            'ocupacao'                       => $this->ocupacao,
            'autoriza_uso_imagem'            => $this->autoriza_uso_imagem,
            'saida_liberada'                 => $this->saida_liberada,
        ];
    }
}
