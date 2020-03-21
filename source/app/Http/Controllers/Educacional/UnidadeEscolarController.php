<?php
namespace App\Http\Controllers\Educacional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

use Models\Educacional\UnidadeEscolar;

class UnidadeEscolarController extends Controller
{
    protected $folderView = 'unidade-escolar';

    public function index(){
        $data = UnidadeEscolar::orderBy('nomeCompleto')->get();
        return view( $this->folderView.'.list', ['data' => $data] );
    }

    public function create(){
        $data = new UnidadeEscolar;
        return view( $this->folderView.'.form', ['data' => $data]);
    }

    public function edit(UnidadeEscolar $unidades_escolare){
        // Show the form for editing the specified resource.  Using Implicit Binding.
        return view( $this->folderView.'.form', ['data' => $unidades_escolare]);
    }

    public function store(Request $request){
        $formData = $request->all();

        $validation = Validator::make($formData['unidade'], [
            'inep' => [
                'required',
                Rule::unique('unidadesEscolares','inep'),
            ],
            'nomeCompleto' => 'required|max:60',
            'nomeAbreviado' => 'required|max:30',
            'localizacao' => 'in:urbana,rural',
            'inativo' => 'boolean'
        ]);

        if ($validation->fails()) {
            return Redirect::route('unidades-escolares.create')->withErrors($validation)->withInput();
        }else{
            $unidade = new UnidadeEscolar;
            $unidade->fill($formData['unidade']);
            $unidade->save();

            return Redirect::route('unidades-escolares.edit',  $unidade)->with('status', 'success')->with('content', 'Registro criado com sucesso');
        }
    }

    public function update(Request $request, UnidadeEscolar $unidades_escolare){
        $formData = $request->all();

        $formValidation = Validator::make($formData['unidade'], [
            'inep' => [
                'required',
                Rule::unique('unidadesEscolares','inep')->ignore($unidades_escolare->inep, 'inep'),
            ],
            'nomeCompleto' => 'required|max:60',
            'nomeAbreviado' => 'required|max:30',
            'localizacao' => 'in:urbana,rural',
            'inativo' => 'boolean'
        ]);

        if ($formValidation->fails()) {
            return Redirect::route('unidades-escolares.edit', $formData['unidade'])->withErrors($formValidation)->withInput();
        }else{
            $unidades_escolare->fill($formData['unidade']);
            $unidades_escolare->save();

            return Redirect::route('unidades-escolares.edit',  $unidades_escolare)->with('status', 'success')->with('content', 'Registro atualizado com sucesso');
        }
    }

    public function forApiIndex(Request $request){
        $query = trim($request->search);
        //if (empty($query))
            //return response()->json([]);

        $results = UnidadeEscolar::where('inativo', '=', false)
            ->where('inep', '=', '%'.$query.'%')
            ->orWhere('nomeCompleto', 'like', '%'.$query.'%')
            ->get();

        return response()->json([
            'data' => $results,
        ], 200);
    }
}
