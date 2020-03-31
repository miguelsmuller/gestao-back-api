<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Models\Pessoa;
use App\Http\Resources\Pessoa\PessoaResource;
use App\Http\Resources\Pessoa\PessoaCollection;

class PessoaController
{
    public function index(Request $request){
        $query = new Pessoa();
        $query = $query->newQuery();

        $request->has('order') ? $order = $request->get('order') : $order = 'nome_completo';
        $request->has('sort') ? $sort = $request->get('sort') : $sort = 'asc';
        $request->has('per_page') ? $perPage = $request->get('per_page') : $perPage = 10;

        if ($request->has('q')) $query->where('nome_completo', 'like', '%'.$request->get('q').'%');

        if ($request->has('with') == 'endereco') $query = $query->with('endereco');
        if ($request->has('with') == 'user') $query = $query->with('user');
        if ($request->has('with') == 'aluno') $query = $query->with('aluno');

        $query = $query->orderBy($order, $sort)->paginate($perPage);

        return new PessoaCollection($query);
    }

    public function show(Pessoa $pessoa){
        return new PessoaResource($pessoa);
    }

    public function store(Request $request){
        $pessoa = new Pessoa;

        return $this->save($request, $pessoa);
    }

    public function update(Request $request, Pessoa $pessoa){
        return $this->save($request, $pessoa);
    }

    public function save(Request $request, Pessoa $pessoa) {
        if ( $pessoa->exists ){
            array_push( $pessoa->validacaoRegras['cpf'], Rule::unique('pessoas','cpf')->ignore($pessoa->id, 'id'));
        }else{
            array_push( $pessoa->validacaoRegras['cpf'], Rule::unique('pessoas', 'id'));
        }

        $validacao = Validator::make($request->all(), $pessoa->validacaoRegras);

        if ($validacao->fails()) {
            return response()->json([
                'error' => $validacao->errors()
            ], 404);
        }

        $pessoa->fill( $request->all() );
        $pessoa->save();

        if ($request->has('endereco')){
            $pessoa->endereco()->updateOrCreate(['pessoa_id' => $pessoa->id], $request['endereco']);
        }

        return new PessoaResource($pessoa);
    }
}
