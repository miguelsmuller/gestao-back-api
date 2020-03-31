<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Models\VinculoProfissional;
use App\Http\Resources\VinculoProfissional\VinculoProfissionalCollection;
use App\Http\Resources\VinculoProfissional\VinculoProfissionalResource;

class VinculoProfissionalController
{
    public function index(Request $request, $ref){
        $vinculos_profissionai = new VinculoProfissional;

        if ($request->route()->getName() == 'vinculos-profissionais.unidade-escolar.index') {
            $vinculos_profissionai = $vinculos_profissionai::where('inep', '=', $ref);
        } elseif ($request->route()->getName() == 'vinculos-profissionais.pessoa.index') {
            $vinculos_profissionai = $vinculos_profissionai::where('cirme', '=', $ref);
        }

        $vinculos_profissionai = $vinculos_profissionai->paginate();

        return new VinculoProfissionalCollection($vinculos_profissionai);
    }

    public function store(Request $request){
        $vinculos_profissionai = new VinculoProfissional;

        return $this->save($request, $vinculos_profissionai);
    }

    public function update(Request $request, VinculoProfissional $vinculos_profissionai){
        return $this->save($request, $vinculos_profissionai);
    }

    public function save(Request $request, VinculoProfissional $vinculos_profissionai) {
        array_push( $vinculos_profissionai->validacaoRegras['cirme'],
        Rule::exists('pessoas')->where(function ($query) use ($request) {
            return $query->where('cirme', $request->get('cirme'))->where('falecido', false);
        }));

        array_push( $vinculos_profissionai->validacaoRegras['inep'],
        Rule::exists('unidades_escolares')->where(function ($query) use ($request) {
            return $query->where('inep', $request->get('inep'))->where('inativo', false);
        }));

        //array_push( $vinculos_profissionai->validacaoRegras['id_cargo'],
        //Rule::exists('cargos')->where(function ($query) use ($request) {
            //return $query->where('id', $request->get('id_cargo'))->where('inativo', false);
            //return $query->where('teste', 1);
        //}));

        array_push( $vinculos_profissionai->validacaoRegras['id_cargo'], 'exists:cargos,id');
        array_push( $vinculos_profissionai->validacaoRegras['id_cargo'],
        Rule::exists('cargos')->where(function ($query) {
            $query->where('inativo', false);
        }));

        $validacao = Validator::make($request->all(), $vinculos_profissionai->validacaoRegras);

        if ($validacao->fails()) {
            return response()->json([
                'error' => $validacao->errors()
            ], 404);
        }

        $vinculos_profissionai->fill( $request->all() );
        $vinculos_profissionai->save();

        return new VinculoProfissionalResource($vinculos_profissionai);
    }
}
