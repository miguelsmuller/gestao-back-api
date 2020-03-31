<?php

namespace App\Http\Resources\Pessoa;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Endereco\EnderecoResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Aluno\AlunoResource;

class PessoaResource extends JsonResource
{
    public function toArray($request){
        return [
            'id'              => $this->id,
            'nome_completo'   => $this->nome_completo,
            'data_nascimento' => $this->data_nascimento->format('Y-m-d'),
            'cpf'             => $this->cpf,
            'sexo'            => $this->sexo,
            'telefone'        => $this->telefone,
            'email'           => $this->email,
            'created_at'      => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'      => $this->updated_at->format('Y-m-d H:i:s'),
            'endereco'        => new EnderecoResource($this->whenLoaded('endereco')),
            'user'            => new UserResource($this->whenLoaded('user')),
            'aluno'           => new AlunoResource($this->whenLoaded('aluno')),
        ];
    }
}
