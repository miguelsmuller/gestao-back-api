<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Models\Cargo;
use App\Http\Resources\Cargo\CargoCollection;
use App\Http\Resources\Cargo\CargoResource;

class CargoController
{
    public function index(Request $request){
        $query = new Cargo();
        $query = $query->newQuery();

        $request->has('order') ? $order = $request->get('order') : $order = 'nome';
        $request->has('sort') ? $sort = $request->get('sort') : $sort = 'asc';
        $request->has('per_page') ? $perPage = $request->get('per_page') : $perPage = 10;

        if ($request->has('q')) $query->where('nome', 'like', '%'.$request->get('q').'%');

        $query = $query->orderBy($order, $sort)->paginate($perPage);

        return new CargoCollection($query);
    }

    public function show(Cargo $cargo){
        return new CargoResource($cargo);
    }

    public function store(Request $request){
        $cargo = new Cargo;

        return $this->save($request, $cargo);
    }

    public function update(Request $request, Cargo $cargo){
        return $this->save($request, $cargo);
    }

    public function save(Request $request, Cargo $cargo) {
        $validacao = Validator::make($request->all(), $cargo->validacaoRegras);

        if ($validacao->fails()) {
            return response()->json([
                'error' => $validacao->errors()
            ], 404);
        }

        $cargo->fill( $request->all() );
        $cargo->save();

        return new CargoResource($cargo);
    }
}
