<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Models\UnidadeEscolar;
use App\Http\Resources\UnidadeEscolar\UnidadeEscolarCollection;
use App\Http\Resources\UnidadeEscolar\UnidadeEscolarResource;

class UnidadeEscolarController
{
    public function index(Request $request){
        $query = new UnidadeEscolar();
        $query = $query->newQuery();

        $request->has('order') ? $order = $request->get('order') : $order = 'nome_completo';
        $request->has('sort') ? $sort = $request->get('sort') : $sort = 'asc';
        $request->has('per_page') ? $perPage = $request->get('per_page') : $perPage = 10;

        if ($request->has('q')) {
            $query->where('nome_completo', 'like', '%'.$request->get('q').'%');
            $query->orWhere('inep', 'like', $request->get('q').'%');
        }

        $query = $query->orderBy($order, $sort)->paginate($perPage);

        return new UnidadeEscolarCollection($query);
    }

    public function show(UnidadeEscolar $unidades_escolare){
        return new UnidadeEscolarResource($unidades_escolare);
    }

    public function store(Request $request){
        $unidades_escolare = new UnidadeEscolar;

        return $this->save($request, $unidades_escolare);
    }

    public function update(Request $request, UnidadeEscolar $unidades_escolare){
        return $this->save($request, $unidades_escolare);
    }

    public function save(Request $request, UnidadeEscolar $unidades_escolare) {
        if ( $unidades_escolare->exists ){
            array_push( $unidades_escolare->validacaoRegras['inep'], Rule::unique('unidades_escolares','inep')->ignore($unidades_escolare->inep, 'inep'));
        }else{
            array_push( $unidades_escolare->validacaoRegras['inep'], Rule::unique('unidades_escolares','inep'));
        }

        $validacao = Validator::make($request->all(), $unidades_escolare->validacaoRegras);

        if ($validacao->fails()) {
            return response()->json([
                'error' => $validacao->errors()
            ], 404);
        }

        $unidades_escolare->fill( $request->all() );
        $unidades_escolare->save();

        return new UnidadeEscolarResource($unidades_escolare);
    }
}
