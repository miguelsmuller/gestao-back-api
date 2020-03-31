<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Models\AnoEscolaridade;
use App\Http\Resources\AnoEscolaridade\AnoEscolaridadeResource;
use App\Http\Resources\AnoEscolaridade\AnoEscolaridadeCollection;

class AnoEscolaridadeController
{
    public function index(Request $request){
        $query = new AnoEscolaridade();
        $query = $query->newQuery();

        $request->has('order') ? $order = $request->get('order') : $order = 'nome_completo';
        $request->has('sort') ? $sort = $request->get('sort') : $sort = 'asc';
        $request->has('per_page') ? $perPage = $request->get('per_page') : $perPage = 10;

        $query = $query->orderBy($order, $sort)->paginate($perPage);

        return new AnoEscolaridadeCollection($query);
    }

    public function show(AnoEscolaridade $anos_escolaridade){
        return new AnoEscolaridadeResource($anos_escolaridade);
    }

    public function store(Request $request){
        $anos_escolaridade = new AnoEscolaridade;

        return $this->save($request, $anos_escolaridade);
    }

    public function update(Request $request, AnoEscolaridade $anos_escolaridade){
        return $this->save($request, $anos_escolaridade);
    }

    public function save(Request $request, AnoEscolaridade $anos_escolaridade) {
        $validacao = Validator::make($request->all(), $anos_escolaridade->validacaoRegras);

        if ($validacao->fails()) {
            return response()->json([
                'error' => $validacao->errors()
            ], 404);
        }

        $anos_escolaridade->fill( $request->all() );
        $anos_escolaridade->save();

        return new AnoEscolaridadeResource($anos_escolaridade);
    }
}
