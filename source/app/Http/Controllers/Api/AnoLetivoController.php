<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Models\AnoLetivo;
use App\Http\Resources\AnoLetivo\AnoLetivoResource;
use App\Http\Resources\AnoLetivo\AnoLetivoCollection;

class AnoLetivoController
{
    public function index(Request $request){
        $query = new AnoLetivo();
        $query = $query->newQuery();

        $request->has('order') ? $order = $request->get('order') : $order = 'ano_letivo';
        $request->has('sort') ? $sort = $request->get('sort') : $sort = 'desc';
        $request->has('per_page') ? $perPage = $request->get('per_page') : $perPage = 10;

        $query = $query->orderBy($order, $sort)->paginate($perPage);

        return new AnoLetivoCollection($query);
    }

    public function show(AnoLetivo $anos_letivo){
        return new AnoLetivoResource($anos_letivo);
    }

    public function store(Request $request){
        $ano_letivo = new AnoLetivo;

        return $this->save($request, $ano_letivo);
    }

    public function update(Request $request, AnoLetivo $anos_letivo){
        return $this->save($request, $anos_letivo);
    }

    public function save(Request $request, AnoLetivo $anos_letivo) {
        if ( $anos_letivo->exists ){
            array_push( $anos_letivo->validacaoRegras['ano_letivo'],
            Rule::unique('anos_letivos','ano_letivo')->ignore($anos_letivo->ano_letivo, 'ano_letivo'));
        }else{
            array_push( $anos_letivo->validacaoRegras['ano_letivo'],
            Rule::unique('anos_letivos','ano_letivo'));
        }

        $validacao = Validator::make($request->all(), $anos_letivo->validacaoRegras);

        if ($validacao->fails()) {
            return response()->json([
                'error' => $validacao->errors()
            ], 404);
        }

        $anos_letivo->fill( $request->all() );
        $anos_letivo->save();

        return new AnoLetivoResource($anos_letivo);
    }
}
