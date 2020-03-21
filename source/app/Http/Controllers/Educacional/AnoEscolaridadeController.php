<?php
namespace App\Http\Controllers\Educacional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Models\Educacional\AnoEscolaridade;

class AnoEscolaridadeController extends Controller
{
    protected $folderView = 'ano-escolaridade';

    public function index(){
        $data = AnoEscolaridade::orderBy('nomeCompleto', 'desc')->get();
        return view( $this->folderView.'.list', ['data' => $data] );
    }

    public function create(){
        $data = new AnoEscolaridade;
        return view( $this->folderView.'.form', ['data' => $data]);
    }

    public function edit(AnoEscolaridade $anos_escolaridade){
        // Show the form for editing the specified resource.  Using Implicit Binding.
        return view( $this->folderView.'.form', ['data' => $anos_escolaridade]);
    }

    public function store(Request $request){
        $formData = $request->all();

        $formData['anoEscolaridade']['inativo'] = (isset($request->anoEscolaridade['inativo'])) ? true : false;

        $validation = Validator::make($formData['anoEscolaridade'], [
            'nomeCompleto' => [
                'max:60',
                'required',
            ],
            'nomeAbreviado' => [
                'max:6',
                'required',
            ],
            'inativo' => [
                'boolean',
                'required',
            ]
        ]);

        if ($validation->fails()) {
            return Redirect::route('anos-escolaridades.create')->withErrors($validation)->withInput();
        }else{
            $anoEscolaridade = new AnoEscolaridade;
            $anoEscolaridade->fill($formData['anoEscolaridade']);
            $anoEscolaridade->save();

            return Redirect::route('anos-escolaridades.edit',  $anoEscolaridade)->with('status', 'success')->with('content', 'Registro criado com sucesso');
        }
    }

    public function update(Request $request, AnoEscolaridade $anos_escolaridade){
        $formData = $request->all();

        $formData['anoEscolaridade']['inativo'] = (isset($request->anoEscolaridade['inativo'])) ? true : false;

        $formValidation = Validator::make($formData['anoEscolaridade'], [
            'nomeCompleto' => [
                'max:60',
                'required',
            ],
            'nomeAbreviado' => [
                'max:6',
                'required',
            ],
            'inativo' => [
                'boolean',
                'required',
            ]
        ]);

        if ($formValidation->fails()) {
            return Redirect::route('anos-escolaridades.edit', $anos_escolaridade)->withErrors($formValidation)->withInput();
        }else{
            $anos_escolaridade->fill($formData['anoEscolaridade']);
            $anos_escolaridade->save();

            return Redirect::route('anos-escolaridades.edit',  $anos_escolaridade)->with('status', 'success')->with('content', 'Registro atualizado com sucesso');
        }
    }
}
